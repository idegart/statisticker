<?php

namespace Root\Core\Contracts;

interface MetricRepositoryInterface
{
    public function hitCountry(string $country): void;

    public function getCountries(): array;
}