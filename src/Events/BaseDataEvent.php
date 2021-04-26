<?php
declare(strict_types=1);

namespace TimoBakx\ApiEventsBundle\Events;

abstract class BaseDataEvent extends BaseEvent
{
    /**
     * @var mixed|null
     */
    private $data;

    /**
     * @param mixed|null $data
     */
    public function __construct(string $resourceClass, string $operationType, string $operationName, $data)
    {
        parent::__construct($resourceClass, $operationType, $operationName);

        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }
}
