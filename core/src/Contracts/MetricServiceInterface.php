<?php

namespace Root\Core\Contracts;

interface MetricServiceInterface
{
    public function hitCountry(string $country): void;

    public function getCountries(): array;
}