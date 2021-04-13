<?php
declare(strict_types=1);

namespace TimoBakx\ApiEventsBundle\Events;

use Symfony\Component\HttpFoundation\Request;

final class RequestParser
{
    private const COLLECTION_OPERATION = '_api_collection_operation_name';
    private const ITEM_OPERATION = '_api_item_operation_name';
    private const RESOURCE_CLASS = '_api_resource_class';

    public function isApiRequest(Request $request): bool
    {
        try {
            return $this->getOperationName($request) !== ''
                && $this->getResourceClass($request) !== '';
        } catch (\LogicException $exception) {
            return false;
        }
    }

    public function isCollectionOperation(Request $request): bool
    {
        return $request->attributes->has(self::COLLECTION_OPERATION);
    }

    public function isItemOperation(Request $request): bool
    {
        return $request->attributes->has(self::ITEM_OPERATION);
    }

    public function getOperationType(Request $request): string
    {
        if ($this->isCollectionOperation($request)) {
            return BaseEvent::OPERATION_TYPE_COLLECTION;
        }

        if ($this->isItemOperation($request)) {
            return BaseEvent::OPERATION_TYPE_ITEM;
        }

        throw new \LogicException('Operation is neither an item or collection operation');
    }

    public function getOperationName(Request $request): string
    {
        if ($this->isCollectionOperation($request)) {
            return $request->attributes->get(self::COLLECTION_OPERATION);
        }

        if ($this->isItemOperation($request)) {
            return $request->attributes->get(self::ITEM_OPERATION);
        }

        throw new \LogicException('Operation is neither an item or collection operation');
    }

    public function getResourceClass(Request $request): string
    {
        if (!$request->attributes->has(self::RESOURCE_CLASS)) {
            throw new \LogicException('No resource class defined for this operation');
        }

        return $request->attributes->get(self::RESOURCE_CLASS);
    }
}
