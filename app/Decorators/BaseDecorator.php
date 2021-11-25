<?php

namespace App\Decorators;

use App\DataProviderInterface;

//Базовый декоратор
class BaseDecorator implements DataProviderInterface
{
    public function __construct
    (
        protected DataProviderInterface $component
    )
    {
    }

    /**
     * @param array $request
     * @return array
     */
    public function get(array $request): array
    {
        return $this->component->get($request);
    }
}