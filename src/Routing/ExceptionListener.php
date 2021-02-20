<?php

namespace App\Routing;

use Psl\Type\Exception\AssertException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ExceptionListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            ExceptionEvent::class => 'onException'
        ];
    }

    public function onException(ExceptionEvent $event): void
    {
        if ($_SERVER['APP_ENV'] === 'dev') {
            return;
        }

        if ($event->getThrowable() instanceof AssertException) {
            $event->setResponse(new JsonResponse(['message' => $event->getThrowable()->getMessage()], Response::HTTP_BAD_REQUEST));
        }

        if ($event->getThrowable() instanceof HttpException) {
            $event->setResponse(new Response($event->getThrowable()->getMessage(), $event->getThrowable()->getStatusCode(), ['Content-Type' => 'application/json']));
        }
    }
}
