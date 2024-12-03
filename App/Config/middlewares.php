<?php

namespace Scooby\Http;

use Scooby\Middlewares\TesteMiddleware;

class Middlewares
{
    /**
     * Exemplo de uso registro de middleware para serem executadas em todas as rotas
     *
     *  \Scooby\Middlewares\Teste::class,
     *
     * @var array
     */
    public static $middleware = [
        //
        TesteMiddleware::class,
    ];

    /**
     * Exemplo de uso registro de middleware para ser executada em uma rota especiifica
     *
     *  'HomeController@teste' => Scooby\Middlewares\TesteRoute::class,
     *  or
     *  'HomeController@teste' => [
     *      Scooby\Middlewares\TesteRoute::class,
     *      Scooby\Middlewares\TesteRoute2::class,
     *  ]
     *
     * @var array
     */
    public static $middlewareAction = [
        //
    ];
}
