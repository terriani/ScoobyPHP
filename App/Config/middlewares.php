<?php

namespace Scooby\Http;

class Middlewares
{
    /**
     * Exemplo de uso registro de middleware para serem executadas em todas as rotas
     *
     *  Scooby\Middlewares\Teste::class,
     *
     * @var array
     */
    public static $middleware = [
        //
    ];

    /**
     * Exemplo de uso registro de middleware para ser executada em uma rota especiifica
     *
     *  'HomeController@teste' => Scooby\Middlewares\TesteRoute::class,
     *
     * @var array
     */
    public static $middlewareAction = [
        //
    ];
}