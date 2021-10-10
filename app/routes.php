<?php

declare(strict_types=1);

use App\Action\User\UserCreateAction;
use Slim\App;

return function (App $app) {
    $app->get('/', \App\Action\HomeAction::class)->setName('home');
    $app->post('/users', UserCreateAction::class);
};
