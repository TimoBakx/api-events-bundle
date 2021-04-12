<?php
declare(strict_types=1);

namespace TimoBakx\ApiEventsBundle\ApiPlatformListeners;

use Symfony\Component\HttpKernel\Event\RequestEvent;

interface BeforeDeserialize
{
    public function __invoke(RequestEvent $event): void;
}
