<?php
declare(strict_types=1);

namespace TimoBakx\ApiEventsBundle\Events\BeforeRead;

use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use TimoBakx\ApiEventsBundle\ApiPlatformListeners\BeforeRead;
use TimoBakx\ApiEventsBundle\Events\RequestParser;

final class Listener implements BeforeRead
{
    private RequestParser $requestParser;
    private EventDispatcherInterface $dispatcher;

    public function __construct(RequestParser $requestParser, EventDispatcherInterface $dispatcher)
    {
        $this->requestParser = $requestParser;
        $this->dispatcher = $dispatcher;
    }

    public function __invoke(RequestEvent $event): void
    {
        $request = $event->getRequest();

        if (!$this->requestParser->isApiRequest($request)) {
            return;
        }

        $localEvent = new BeforeReadEvent(
            $this->requestParser->getResourceClass($request),
            $this->requestParser->getOperationType($request),
            $this->requestParser->getOperationName($request)
        );

        $this->dispatcher->dispatch($localEvent);

        $response = $localEvent->getResponse();
        if ($response !== null) {
            $event->setResponse($response);
        }
    }
}
