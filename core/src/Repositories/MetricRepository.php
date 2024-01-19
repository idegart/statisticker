<?php

namespace Root\Core\Repositories;

use Predis\ClientInterface;
use Root\Core\Contracts\MetricRepositoryInterface;

class MetricRepository implements MetricRepositoryInterface
{
    const STORAGE_PREFIX = "storage:countries";
    const STORAGE_ALL_COUNTRIES_KEY = self::STORAGE_PREFIX . ":*";
    const STORAGE_KEY_TEMPLATE = self::STORAGE_PREFIX . ":%s";

    public function __construct(
        private readonly ClientInterface $storage
    )
    {
    }

    public function hitCountry(string $country): void
    {
        $this->storage->incr(sprintf(self::STORAGE_KEY_TEMPLATE, $country));
    }

    public function getCountries(): array
    {
        $keys = $this->storage->keys(self::STORAGE_ALL_COUNTRIES_KEY);

        if (!$keys) {
            return [];
        }

        $values = $this->storage->mget($keys);

        $data = array_combine($keys, $values);

        foreach ($data as $key => $value) {
            $data[str_replace(self::STORAGE_PREFIX . ':', '', $key)] = $value;
            unset($data[$key]);
        }

        return $data;
    }
}