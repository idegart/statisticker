<?php

error_reporting(0);

require_once '../vendor/autoload.php';

use Root\Core\HTTP\Route;
use Root\Core\HTTP\Router;
use Root\Core\Repositories\MetricRepository;
use Root\Core\Services\MetricService;

$storage = new Predis\Client([
    'host' => 'storage',
    'port' => 6379,
]);

$metricService = new MetricService(
    metricRepository: new MetricRepository(
        storage: $storage,
    ),
);

$router = new Router(
    function () {
        http_response_code(404);
        return 'Not found';
    },
    new Route(method: "POST", path: "/", handler: handleStoreCountry($metricService)),
    new Route(method: "GET", path: "/", handler: handleListCountry($metricService)),
);

$handler = $router->getHandlerFor($_SERVER['REQUEST_METHOD'], '/');

try {
    echo $handler();
} catch (InvalidArgumentException $exception) {
    http_response_code(400);
    echo 'validation error';
} catch (Throwable $exception) {
    // todo: logging exception
    http_response_code(500);
    echo 'server error';
}

function handleStoreCountry(MetricService $metricService): Closure {
    return function () use ($metricService): string {
        $code = $_POST['code'] ?? null;

        if (!$code) {
            throw new InvalidArgumentException("Missing country code");
        }

        if (strlen($code) !== 2) {
            throw new InvalidArgumentException("Country code must be 2 characters");
        }

        $metricService->hitCountry($code);

        return 'ok';
    };
}

function handleListCountry(MetricService $metricService): Closure {
    return function () use ($metricService): string {
        return json_encode($metricService->getCountries());
    };
}
