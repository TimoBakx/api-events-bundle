<?php
declare(strict_types=1);

namespace TimoBakx\ApiEventsBundle\Events;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\EventDispatcher\Event as SymfonyEvent;

abstract class BaseEvent extends SymfonyEvent implements Event
{
    public const OPERATION_TYPE_ITEM = 'item';
    public const OPERATION_TYPE_COLLECTION = 'collection';

    private string $resourceClass;
    private string $operationType;
    private string $operationName;
    private ?Response $response = null;

    public function __construct(string $resourceClass, string $operationType, string $operationName)
    {
        $this->resourceClass = $resourceClass;
        $this->operationType = $operationType;
        $this->operationName = $operationName;
    }

    public function isForResourceClass(string $resourceClass): bool
    {
        return $this->resourceClass === $resourceClass;
    }

    public function isACollectionOperation(): bool
    {
        return $this->operationType === self::OPERATION_TYPE_COLLECTION;
    }

    public function isCollectionOperation(string $operationName): bool
    {
        return $this->isACollectionOperation()
            && $this->operationName = $operationName;
    }

    public function isAnItemOperation(): bool
    {
        return $this->operationType === self::OPERATION_TYPE_ITEM;
    }

    public function isItemOperation(string $operationName): bool
    {
        return $this->isAnItemOperation()
            && $this->operationName === $operationName;
    }

    public function sendResponse(Response $response): void
    {
        $this->response = $response;
        $this->stopPropagation();
    }

    public function getResponse(): ?Response
    {
        return $this->response;
    }
}
