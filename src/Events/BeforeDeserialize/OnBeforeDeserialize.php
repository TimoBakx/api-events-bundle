<?php
declare(strict_types=1);

namespace TimoBakx\ApiEventsBundle\Events\BeforeDeserialize;

interface OnBeforeDeserialize
{
    public function __invoke(BeforeDeserializeEvent $event);
}
