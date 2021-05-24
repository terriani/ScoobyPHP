//Rotas do ResourceController $name automaticamente via - Scooby_CLI em dateNow
$route->group("$routeName");
$route->get('/', "$name@index");
$route->get('/create', "$name@create");
$route->post('/store', "$name@store");
$route->get('/show/{id}', "$name@show");
$route->get('/edit/{id}', "$name@edit");
$route->post('/update/{id}', "$name@update");
$route->get('/destroy/{id}', "$name@destroy");
