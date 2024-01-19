<?php

namespace Root\Core\HTTP;

use Closure;

class Route
{
    public function __construct(
        public readonly string $method,
        public readonly string $path,
        public readonly Closure $handler,
    ) {
    }
}