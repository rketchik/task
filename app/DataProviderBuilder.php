<?php

namespace App;

use App\Decorators\Cache;
use App\Decorators\MySql;
use JetBrains\PhpStorm\Pure;

/**
 * Билдер, который соберёт обёрнутый декоратор
 */
class DataProviderBuilder
{
    private bool $enabledLogs = false;
    private bool $enabledCache = false;
    private bool $enabledMySql = false;

    public function __construct
    (
        private DataProvider $dataProvider,
        private CacheItemPoolInterface $cache,
        private SomeRepository $repository,
    )
    {
    }

//  Флаги включения декораторов
    public function enabledCache(): static
    {
        $this->enabledCache = true;

        return $this;
    }

    public function enabledMySql(): static
    {
        $this->enabledMySql = true;

        return $this;
    }

//  Оборачиваем включенными декораторами
    public function getResult(): DataProviderInterface
    {
        $dataProvider = $this->dataProvider;

        if ($this->enabledCache) {
            $dataProvider = new Cache($dataProvider);
        }

        if ($this->enabledMySql) {
            $dataProvider = new MySql($dataProvider);
        }

        return $dataProvider;
    }
}