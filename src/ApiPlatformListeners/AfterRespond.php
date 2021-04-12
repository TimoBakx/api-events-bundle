<?php
declare(strict_types=1);

namespace TimoBakx\ApiEventsBundle\ApiPlatformListeners;

use Symfony\Component\HttpKernel\Event\ResponseEvent;

interface AfterRespond
{
    public function __invoke(ResponseEvent $event): void;
}
