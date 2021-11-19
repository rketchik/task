<?php

namespace App;

interface DataProviderInterface
{
    public function get(array $request): array;
}