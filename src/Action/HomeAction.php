<?php

declare(strict_types=1);

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class HomeAction
{
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $response->getBody()->write(json_encode(['success' => true]));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(422);
    }
}
