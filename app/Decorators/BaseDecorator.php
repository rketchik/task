<?php

namespace App\Decorators;

use App\DataProviderInterface;

class BaseDecorator implements DataProviderInterface
{
    public function __construct
    (
        protected DataProviderInterface $component
    )
    {
    }

    public function get(array $request): array
    {
        return $this->component->get($request);
    }
}