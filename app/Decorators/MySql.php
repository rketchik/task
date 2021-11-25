<?php

namespace App\Decorators;

use App\DataProvider\DataProviderInterface;
use JetBrains\PhpStorm\Pure;

//Декоратор MySql
class MySql extends BaseDecorator
{
    #[Pure] public function __construct
    (
        protected DataProviderInterface $component,
        private SomeRepository $repository,
    )
    {
        parent::__construct($this->component);
    }

    /**
     * Берёт данные из бд, если нет то дальше по цепочке
     * @param array $request
     * @return array
     */
    public function get(array $request): array
    {
        $result = $this->repository->find($request);

        if ($result) {
            return $result;
        }

        $result = parent::get($request);

        $this->repository->save($result);

        return $result;
    }
}