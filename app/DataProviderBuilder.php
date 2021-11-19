<?php

namespace App;

use App\Decorators\Cache;
use App\Decorators\MySql;
use JetBrains\PhpStorm\Pure;

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

    public function enabledLogs(): static
    {
        $this->enabledLogs = true;

        return $this;
    }

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