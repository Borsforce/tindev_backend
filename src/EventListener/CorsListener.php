<?php

declare(strict_types=1);

namespace App\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class CorsListener implements EventSubscriberInterface
{
    protected string $allowHeaders;
    protected string $allowMethods;
    protected string $allowOrigin;

    public function __construct()
    {
        $this->allowHeaders = 'content-type,authorization';
        $this->allowMethods = 'GET,POST,PUT,PATCH,DELETE';
        $this->allowOrigin = '*';
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => ['onKernelRequest', 9999],
            KernelEvents::RESPONSE => ['onKernelResponse', 9999],
            KernelEvents::EXCEPTION => ['onKernelException', 9999],
        ];
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $response = $event->getResponse();
        if ($response) {
            $response->headers->set('Access-Control-Allow-Headers', $this->allowHeaders);
            $response->headers->set('Access-Control-Allow-Methods', $this->allowMethods);
            $response->headers->set('Access-Control-Allow-Origin', $this->allowOrigin);
        }
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        // Don't do anything if it's not the master request.
        if (!$event->isMasterRequest()) {
            return;
        }

        $request = $event->getRequest();
        $method = $request->getRealMethod();

        if (Request::METHOD_OPTIONS === $method) {
            $response = new Response();
            $event->setResponse($response);
        }
    }

    public function onKernelResponse(ResponseEvent $event): void
    {
        // Don't do anything if it's not the master request.
        if (!$event->isMasterRequest()) {
            return;
        }

        $response = $event->getResponse();
        if ($response) {
            $response->headers->set('Access-Control-Allow-Headers', $this->allowHeaders);
            $response->headers->set('Access-Control-Allow-Methods', $this->allowMethods);
            $response->headers->set('Access-Control-Allow-Origin', $this->allowOrigin);
        }
    }
}
