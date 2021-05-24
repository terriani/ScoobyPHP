//Rotas do ResourceController $name automaticamente via - Scooby_CLI em dateNow
$route->group("api");
$route->post('/store', "$name@store");
$route->post('/update/{id}', "$name@update");
$route->get('/destroy/{id}', "$name@destroy");
