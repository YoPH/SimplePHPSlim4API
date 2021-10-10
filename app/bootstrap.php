<?php

use DI\ContainerBuilder;
use Dotenv\Dotenv;
use Slim\App;

require_once __DIR__ . '/../vendor/autoload.php';

$containerBuilder = new ContainerBuilder();

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$dotenv->required(['PRODUCTION_MODE', 'TIMEZONE']);

// Convert "true/false" string from phpdotenv to boolean
define('IS_PRODUCTION_MODE', filter_var($_ENV['PRODUCTION_MODE'], FILTER_VALIDATE_BOOLEAN));
define('IS_DEBUG_MODE', !IS_PRODUCTION_MODE);

// Set up settings
$containerBuilder->addDefinitions(__DIR__ . '/container.php');

if (IS_PRODUCTION_MODE) {
    $containerBuilder->enableCompilation(__DIR__ . '/../var/cache');
}

// Build PHP-DI Container instance
$container = $containerBuilder->build();

// Create App instance
$app = $container->get(App::class);

// Register routes
(require __DIR__ . '/routes.php')($app);

// Register middleware
(require __DIR__ . '/middleware.php')($app);

// Set up repositories
/*(require __DIR__ . '/repositories.php')($app);
$repositories = require __DIR__ . '/repositories.php';*/

// Set up dependencies
/*(require __DIR__ . '/repositories.php')($app);
$repositories = require __DIR__ . '/dependencies.php';*/


return $app;
