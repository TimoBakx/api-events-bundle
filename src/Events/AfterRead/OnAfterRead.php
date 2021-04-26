<?php
declare(strict_types=1);

namespace TimoBakx\ApiEventsBundle\Events\AfterRead;

interface OnAfterRead
{
    public function __invoke(AfterReadEvent $event);
}
