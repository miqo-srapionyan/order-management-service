<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Controller\OrderController;
use App\Controller\ProductController;
use Slim\Factory\AppFactory;
use DI\Container;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$container = new Container();
$dependencies = require __DIR__ . '/../dependencies.php';
$dependencies($container);

AppFactory::setContainer($container);
$app = AppFactory::create();
$app->addBodyParsingMiddleware();

$app->post('/orders', [OrderController::class, 'create']);
$app->get('/orders', [OrderController::class, 'list']);
$app->get('/products', [ProductController::class, 'list']);

$app->run();
