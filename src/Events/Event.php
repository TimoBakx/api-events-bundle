<?php
declare(strict_types=1);

namespace TimoBakx\ApiEventsBundle\Events;

use Symfony\Component\HttpFoundation\Response;

interface Event
{
    public function isForResourceClass(string $resourceClass): bool;
    public function isCollectionOperation(string $operationName): bool;
    public function isItemOperation(string $operationName): bool;

    public function sendResponse(Response $response): void;
    public function getResponse(): ?Response;
}
