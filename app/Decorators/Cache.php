<?php

namespace App\Decorators;

use JetBrains\PhpStorm\Pure;

class Cache extends BaseDecorator
{
    #[Pure] public function __construct
    (
        protected DataProviderInterface $component,
        private CacheItemPoolInterface $cache
    )
    {
        parent::__construct($this->component);
    }

    public function get(array $request): array
    {
        $cacheKey = $this->getCacheKey($request);
        $cacheItem = $this->cache->getItem($cacheKey);
        if ($cacheItem->isHit()) {
            return $cacheItem->get();
        }

        $result = parent::get($request);

        $cacheItem
            ->set($result)
            ->expiresAt(
                (new DateTime())->modify('+1 day')
            );

        return $result;
    }

    private function getCacheKey(array $input): bool|string
    {
        return json_encode($input);
    }
}