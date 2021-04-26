<?php
declare(strict_types=1);

namespace TimoBakx\ApiEventsBundle\Events\AfterDeserialize;

interface OnAfterDeserialize
{
    public function __invoke(AfterDeserializeEvent $event);
}
