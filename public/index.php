<?php
declare(strict_types=1);

use App\Application\Handler\HttpErrorHandler;
use App\Application\Handler\ShutdownHandler;
use App\Application\ResponseEmitter\ResponseEmitter;
use App\Application\Setting\SettingsInterface;

require __DIR__ . '/../vendor/autoload.php';

// Set up settings
(require __DIR__ . '/../app/bootstrap.php')->run();
