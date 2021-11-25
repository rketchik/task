<?php

use App\DataProvider;
use App\DataProviderBuilder;

require dirname(__DIR__) . '/vendor/autoload.php';

//какие то данные для апи
$data = ['' => ''];

$dataProvider = new DataProvider(
    'host',
    'user',
    'password'
);

//билдим декорированный провайдер
$dataProvider = (new DataProviderBuilder($dataProvider))
    ->enabledLogs()
    ->enabledCache()
    ->enabledMySql()
    ->getResult();

//получаем данные
$dataProvider->get($data);