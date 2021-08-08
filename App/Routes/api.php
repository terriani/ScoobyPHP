<?php

use Scooby\Http\Response;

//Exemplo de rotas sem autenticação API
$route->group('api');
$route->get('/', function() {
    Response::json(['data' => 'Bem-vindo ao ScoobyPHP']);
});
