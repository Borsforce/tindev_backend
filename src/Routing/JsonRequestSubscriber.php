<?php

namespace App\Routing;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class JsonRequestSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            RequestEvent::class => 'onRequest'
        ];
    }

    public function onRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();

        if ($request->isMethod('POST') && $request->getContentType() === 'json') {
            try {
                $payload = json_decode($request->getContent(), 512, JSON_THROW_ON_ERROR);

                $request->request->replace($payload);
            } catch (\JsonException $e) {
                $event->setResponse(new JsonResponse(['message' => 'Invalid JSON'], Response::HTTP_BAD_REQUEST));
            }
        }
    }
}
