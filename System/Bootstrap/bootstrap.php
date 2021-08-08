<?php

use Scooby\Guard\Csrf;
use Scooby\Helpers\Redirect;
use Scooby\Helpers\Session as sess;
use Scooby\Guard\Jwt;
use Dotenv\Dotenv;
use Scooby\Log\Log;

session_start();
if (!file_exists('vendor/autoload.php')) {
    throw( new Exception('Falha ao executar o autoload, por favor rode o comando composer install no terminal e recarregue a pagina novamente'));
}
require_once 'vendor/autoload.php';
$dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();
$configs = scandir('App/Config/');
array_shift($configs);
array_shift($configs);
foreach ($configs as $config) {
    if (
        $config != 'Lang' and
        $config != 'index.php' and
        $config != 'twigGlobalVariables.php' and
        $config != 'viewsAuthentication.php' and
        $config != 'assetsInclude.php'
    ) {
        require_once "App/Config/$config";
    }
}
require_once 'System/Core/MiniFiles.php';
require_once 'App/Config/Lang/'.SITE_LANG.'.php';
Jwt::jwtKeyGenerate();
if (IS_API == 'true') {
    header("Access-Control-Allow-Origin: ".ORIGIN_ALLOW."");
    if (CREDENTIALS_ALLOW == 'true') {
        header("Access-Control-Allow-Credentials: true");
    }
    header("Access-Control-Max-Age: 1728000");
    header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
    header("Access-Control-Allow-Methods: ".METHODS_ALLOW."");
}
sess::sessionTokenGenerate();
if (!sess::sessionTokenValidade()) {
    if (getenv('SESSION_VALIDADTION') == 'true') {
        Log::log('Falha na autenticação do hash de sessão');
        die('Opss... Algo saiu errado por favor tente novamente');
    }
}
if (empty($_SESSION['cacheNamespace'])) {
    $_SESSION['cacheNamespace'] = uniqid();
}
Csrf::csrfTokengenerate();
if (getenv('ENV') === 'development') {
    $whoops = new \Whoops\Run;
    $errorPage = new Whoops\Handler\PrettyPageHandler();
    $whoops->prependHandler(new \Whoops\Handler\PrettyPageHandler);
    $errorPage->setPageTitle("Opss... Algo deu errado!");
    $errorPage->setEditor("vscode");
    $whoops->prependHandler($errorPage);
    $whoops->register();
} else {
    error_reporting(0);
}
if (!isset($_SESSION['pageTitle']) or empty($_SESSION['pageTitle'])) {
    $_SESSION['pageTitle'] = APP_NAME;
}
MiniFiles::miniCss('App/Public/assets/css/');
MiniFiles::miniJs('App/Public/assets/js/');
$route = new Scooby\Router\Router(BASE_URL);
$route->namespace('Scooby\Controllers');
$dir = scandir("App/Routes/");
$dir = (array) $dir;
array_shift($dir);
array_shift($dir);
foreach ($dir as $file) {
    require_once "App/Routes/$file";
}
$route->get('/denied', function() {
    Log::log('Tentativa de acesso a área restrita');
    $url = $_SERVER['SERVER_NAME'];
    Redirect::redirectTo($url."/".ROUTE_ERROR."/");
    return false;
});
$route->group(ROUTE_ERROR);
$route->get('/', 'NotfoundController@index');
$route->dispatch();
if ($route->error()) {
    $_SESSION['httpCode'] = $route->error();
    $route->redirect("/".ROUTE_ERROR."/");
}
