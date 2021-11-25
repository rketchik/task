<?php

namespace App\Decorators;

use JetBrains\PhpStorm\Pure;

//Декоратор Cache
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

    /**
     * Берёт данные из кеша, если нет то дальше по цепочке
     * @param array $request
     * @return array
     */
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

    /**
     * @param array $input
     * @return bool|string
     */
    private function getCacheKey(array $input): bool|string
    {
        return json_encode($input);
    }
}