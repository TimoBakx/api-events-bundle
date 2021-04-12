# ApiEventsBundle

## About

This Symfony bundle provides autoconfigured interfaces to more easily autowire
lazy event listeners for API Platform.

## Installation

Make sure Composer is installed globally, as explained in the
[installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

### Applications that use Symfony Flex

Open a command console, enter your project directory and execute:

```console
$ composer require timobakx/api-events-bundle
```

### Applications that don't use Symfony Flex

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require timobakx/api-events-bundle
```

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
// config/bundles.php

return [
    // ...
    TimoBakx\ApiEventsBundle\ApiEventsBundle::class => ['all' => true],
];
```

## Usage

Create an event listener and implement one of the interfaces from the
`TimoBakx\ApiEventsBundle\ApiPlatformListeners` namespace:

```php
<?php
declare(strict_types=1);

// src/EventListener/DoSomethingAfterWriting.php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\ViewEvent;
use TimoBakx\ApiEventsBundle\ApiPlatformListeners\AfterWrite;

final class DoSomethingAfterWriting implements AfterWrite
{
    public function __invoke(ViewEvent $event): void
    {
        // Check for the correct object, method and/or operation name
    
        // Do something
    }
}
```

The event listener will be automatically configured for the correct tag,
including the correct event and priority.
