<?php

//Middleware gerado automaticamente via Scooby-CLI em 29-05-23 - 23:44:pm

namespace Scooby\Middlewares;

use Scooby\Http\Middleware;
use Scooby\Http\MiddlewareInterface;

class TesteMiddleware extends Middleware implements MiddlewareInterface
{
    public function handle($request)
    {
        // content

        return $request;
    }
}
