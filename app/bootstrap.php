<?php

use DI\ContainerBuilder;
use Dotenv\Dotenv;
use Slim\App;

require_once __DIR__ . '/../vendor/autoload.php';

$containerBuilder = new ContainerBuilder();

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$dotenv->required(['PRODUCTION_MODE']);

// Convert "true/false" string from phpdotenv to boolean
define('PRODUCTION_MODE', filter_var($_ENV['PRODUCTION_MODE'], FILTER_VALIDATE_BOOLEAN));
define('DEBUG_MODE', !PRODUCTION_MODE);

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
