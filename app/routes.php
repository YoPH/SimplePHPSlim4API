<?php

declare(strict_types=1);

use App\Application\Action\User\ListUsersAction;
use App\Application\Action\User\ViewUserAction;
use App\Application\Action\User\UserCreateAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->get('/', \App\Action\HomeAction::class)->setName('home');
    $app->post('/users', UserCreateAction::class);
};
