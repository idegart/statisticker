<?php

namespace Root\Core\Services;

use Root\Core\Contracts\MetricRepositoryInterface;
use Root\Core\Contracts\MetricServiceInterface;

class MetricService implements MetricServiceInterface
{
    public function __construct(
        private readonly MetricRepositoryInterface $metricRepository,
    ) {
    }

    public function hitCountry(string $country): void
    {
        $this->metricRepository->hitCountry($country);
    }

    public function getCountries(): array
    {
        return $this->metricRepository->getCountries();
    }
}