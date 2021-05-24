<?php

use Scooby\Helpers\Response;

//Exemplo de rotas sem autenticação API
$route->group('api');
$route->get('/', function() {
    Response::Json(['data' => 'Bem-vindo ao ScoobyPHP']);
});
