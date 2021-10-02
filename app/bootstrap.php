<?php

use DI\ContainerBuilder;
use Slim\App;
use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

$containerBuilder = new ContainerBuilder();

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$dotenv->required(['PRODUCTION_MODE']);

// Set up settings
$containerBuilder->addDefinitions(__DIR__ . '/container.php');

// Build PHP-DI Container instance
$container = $containerBuilder->build();

// Create App instance
$app = $container->get(App::class);

// Register routes
(require __DIR__ . '/routes.php')($app);

// Register middleware
(require __DIR__ . '/middleware.php')($app);

return $app;
