<?php

use App\DataProvider;
use App\DataProviderBuilder;

require dirname(__DIR__) . '/vendor/autoload.php';

$data = [];

$dataProvider = new DataProvider(
    'host',
    'user',
    'password'
);

$dataProvider = (new DataProviderBuilder($dataProvider))
    ->enabledLogs()
    ->enabledCache()
    ->enabledMySql()
    ->getResult();

$dataProvider->get($data);