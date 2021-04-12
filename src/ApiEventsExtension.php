<?php
declare(strict_types=1);

namespace TimoBakx\ApiEventsBundle;

use ApiPlatform\Core\EventListener\EventPriorities;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\HttpKernel\KernelEvents;
use TimoBakx\ApiEventsBundle\ApiPlatformListeners\AfterDeserialize;
use TimoBakx\ApiEventsBundle\ApiPlatformListeners\AfterRead;
use TimoBakx\ApiEventsBundle\ApiPlatformListeners\AfterRespond;
use TimoBakx\ApiEventsBundle\ApiPlatformListeners\AfterSerialize;
use TimoBakx\ApiEventsBundle\ApiPlatformListeners\AfterValidate;
use TimoBakx\ApiEventsBundle\ApiPlatformListeners\AfterWrite;
use TimoBakx\ApiEventsBundle\ApiPlatformListeners\BeforeDeserialize;
use TimoBakx\ApiEventsBundle\ApiPlatformListeners\BeforeRead;
use TimoBakx\ApiEventsBundle\ApiPlatformListeners\BeforeSerialize;
use TimoBakx\ApiEventsBundle\ApiPlatformListeners\BeforeValidate;
use TimoBakx\ApiEventsBundle\ApiPlatformListeners\BeforeWrite;

final class ApiEventsExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $this->registerListener($container, BeforeRead::class, KernelEvents::REQUEST, EventPriorities::PRE_READ);
        $this->registerListener($container, AfterRead::class, KernelEvents::REQUEST, EventPriorities::POST_READ);

        $this->registerListener($container, BeforeDeserialize::class, KernelEvents::REQUEST, EventPriorities::PRE_DESERIALIZE);
        $this->registerListener($container, AfterDeserialize::class, KernelEvents::REQUEST, EventPriorities::POST_DESERIALIZE);

        $this->registerListener($container, BeforeValidate::class, KernelEvents::VIEW, EventPriorities::PRE_VALIDATE);
        $this->registerListener($container, AfterValidate::class, KernelEvents::VIEW, EventPriorities::POST_VALIDATE);

        $this->registerListener($container, BeforeWrite::class, KernelEvents::VIEW, EventPriorities::PRE_WRITE);
        $this->registerListener($container, AfterWrite::class, KernelEvents::VIEW, EventPriorities::POST_WRITE);

        $this->registerListener($container, BeforeSerialize::class, KernelEvents::VIEW, EventPriorities::PRE_SERIALIZE);
        $this->registerListener($container, AfterSerialize::class, KernelEvents::VIEW, EventPriorities::POST_SERIALIZE);

        $this->registerListener($container, AfterRespond::class, KernelEvents::RESPONSE, EventPriorities::POST_RESPOND);
    }

    private function registerListener(ContainerBuilder $container, string $interface, string $event, int $priority): void
    {
        $container->registerForAutoconfiguration($interface)
            ->addTag('kernel.event_listener', ['event' => $event, 'priority' => $priority, 'lazy' => true]);
    }
}
