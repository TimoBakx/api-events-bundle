<?php
declare(strict_types=1);

namespace TimoBakx\ApiEventsBundle\ApiPlatformListeners;

use ApiPlatform\Symfony\EventListener\EventPriorities;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\KernelEvents;

final class Registrator
{
    public function __construct(
        private readonly ContainerBuilder $container,
    ) {
    }

    public function addListeners(): void
    {
        $this->add(BeforeRead::class, KernelEvents::REQUEST, EventPriorities::PRE_READ);
        $this->add(AfterRead::class, KernelEvents::REQUEST, EventPriorities::POST_READ);

        $this->add(BeforeDeserialize::class, KernelEvents::REQUEST, EventPriorities::PRE_DESERIALIZE);
        $this->add(AfterDeserialize::class, KernelEvents::REQUEST, EventPriorities::POST_DESERIALIZE);

        $this->add(BeforeValidate::class, KernelEvents::VIEW, EventPriorities::PRE_VALIDATE);
        $this->add(AfterValidate::class, KernelEvents::VIEW, EventPriorities::POST_VALIDATE);

        $this->add(BeforeWrite::class, KernelEvents::VIEW, EventPriorities::PRE_WRITE);
        $this->add(AfterWrite::class, KernelEvents::VIEW, EventPriorities::POST_WRITE);

        $this->add(BeforeSerialize::class, KernelEvents::VIEW, EventPriorities::PRE_SERIALIZE);
        $this->add(AfterSerialize::class, KernelEvents::VIEW, EventPriorities::POST_SERIALIZE);

        $this->add(BeforeRespond::class, KernelEvents::VIEW, EventPriorities::PRE_RESPOND);
        $this->add(AfterRespond::class, KernelEvents::RESPONSE, EventPriorities::POST_RESPOND);
    }

    private function add(string $interface, string $event, int $priority): void
    {
        $this->container->registerForAutoconfiguration($interface)
            ->addTag('kernel.event_listener', ['event' => $event, 'priority' => $priority, 'lazy' => true]);
    }
}
