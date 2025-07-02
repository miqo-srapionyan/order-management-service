<?php

use App\Controller\OrderController;
use App\Controller\ProductController;
use App\Service\ProductService;
use DI\Container;
use App\Service\OrderService;
use App\HttpClient\ProductClient;
use App\Storage\OrderStorage;

use function DI\autowire;
use function DI\create;

return function (Container $container) {
    $container->set(OrderStorage::class, create(OrderStorage::class));
    $container->set(ProductClient::class, create(ProductClient::class));
    $container->set(OrderService::class, autowire(OrderService::class));
    $container->set(ProductService::class, autowire(ProductService::class));
    $container->set(ProductController::class, autowire(ProductController::class));
    $container->set(OrderController::class, autowire(OrderController::class));
};
