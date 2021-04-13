<?php
declare(strict_types=1);

namespace TimoBakx\ApiEventsBundle\Events\BeforeRead;

interface OnBeforeRead
{
    public function __invoke(BeforeReadEvent $event);
}
