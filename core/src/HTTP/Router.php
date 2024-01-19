<?php

namespace Root\Core\HTTP;

use Closure;

class Router
{
    /** @var Route[] */
    private array $routes = [];

    public function __construct(
        private readonly Closure $notFoundHandler,
        Route ...$routes,
    ) {
        foreach ($routes as $route) {
            $this->addRoute($route);
        }
    }

    private function addRoute(Route $route)
    {
        $this->routes[] = $route;
    }

    public function getHandlerFor(string $method, string $path): Closure
    {
        foreach ($this->routes as $route) {
            if ($route->method === $method && $route->path === $path) {
                return $route->handler;
            }
        }

        return $this->notFoundHandler;
    }
}