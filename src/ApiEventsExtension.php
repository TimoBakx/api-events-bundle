<?php
declare(strict_types=1);

namespace TimoBakx\ApiEventsBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use TimoBakx\ApiEventsBundle\ApiPlatformListeners\Registrator;

final class ApiEventsExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        (new Registrator($container))->addListeners();
    }
}
