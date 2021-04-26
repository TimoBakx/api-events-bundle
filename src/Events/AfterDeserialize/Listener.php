<?php
declare(strict_types=1);

namespace TimoBakx\ApiEventsBundle\Events\AfterDeserialize;

use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use TimoBakx\ApiEventsBundle\ApiPlatformListeners\AfterDeserialize;
use TimoBakx\ApiEventsBundle\Events\RequestParser;

final class Listener implements AfterDeserialize
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

        $localEvent = new AfterDeserializeEvent(
            $this->requestParser->getResourceClass($request),
            $this->requestParser->getOperationType($request),
            $this->requestParser->getOperationName($request),
            $this->requestParser->getData($request),
        );

        $this->dispatcher->dispatch($localEvent);

        $response = $localEvent->getResponse();
        if ($response !== null) {
            $event->setResponse($response);
        }
    }
}
