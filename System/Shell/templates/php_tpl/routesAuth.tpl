//Rotas de autenticação geradas automaticamente via Scooby_CLI em dateNow
$route->group(null);
$route->get('/back', 'UserController@goBack');
$route->get('/login', 'UserController@index');
$route->get('/register', 'UserController@register');
$route->post('/new-user', 'UserController@saveUser');
$route->post('/make-login', 'UserController@login');
$route->post('/password-rescue', 'UserController@newPass');
$route->get('/passwordRescue', 'UserController@passwordRescue');
$route->get('/create-password', 'UserController@saveNewPassword');
$route->post('/password-reset', 'UserController@passwordReset');

// Para a criação de rotas autenticadas pode-se usar o metodo auth da classe route
$route->auth(['get'], '/dashboard', 'DashboardController@index');
$route->auth(['get'], '/exit', 'DashboardController@exit');
$route->auth(['delete'], '/delete-user', 'DashboardController@deleteUser');
$route->auth(['get'], '/alter-user', 'DashboardController@alterUser');
$route->auth(['put'], '/update-user', 'DashboardController@updateUser'); 
