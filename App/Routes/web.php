<?php

//Exemplo de rotas sem autenticação WEB
// Group aceita um array com os middlewares aceitos nas rotas do grupo
// Rotas aceitam um array com os middlewares aceitos na rota
$route->group(null);
$route->get('/', 'HomeController@index');
$route->get('/teste', function () {
    echo 'teste';
});

/**
 * Para rota autenticadas no desenvolvimento web podemos usar a rota AUTH
 *
 * EX: $route->auth(['aqui vai um ou mais metodos aceitos na rota'], '/path', 'Controller@metodo');
 *
 * esta rota recebe um array passando os metodos aceitos exemplo: ['get', 'post', 'etc...']
 * o segundo paramentro é um path ex: '/home' e o último parámetro é o controller@metoodo ex: 'HomeController@index'
 */
