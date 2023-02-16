<?php
declare(strict_types=1);

namespace TimoBakx\ApiEventsBundle;

use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class ApiEventsBundle extends Bundle
{
    public function getContainerExtension(): ExtensionInterface
    {
        return new ApiEventsExtension();
    }
}
