<?php

use Scooby\Helpers\Cli;
use Scooby\Helpers\Debug;

class MakeController
{
    public static function execOptionMakeController()
    {
        Cli::println("Você optou por criar um Controller.");
        $name = Cli::getParam('Por favor, DIGITE o nome do controller a ser criado');
        $name = ucfirst($name);
        $name = $name . "Controller";
        if (file_exists("App/Controllers/$name.php")) {
            Cli::println("ERROR: Controller " . $name . " já existente na pasta 'App/Controllers'");
            Debug::log("ERROR: Controller " . $name . " já existente na pasta 'App/Controllers'");
            return;
        }
        $content = file_get_contents('System/Shell/templates/php_tpl/controllerFile.tpl');
        $content = strtr($content, [
            'dateNow' => date('d-m-y - H:i:a'),
            '$name' => $name
        ]);
        $f = fopen("App/Controllers/$name.php", 'w+');
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            Debug::log('Um erro desconhecido ocorreu ao ler o arquivo base do controller');
            return;
        }
        $fw = fwrite($f, $content);
        if ($fw == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            Debug::log('Um erro desconhecido ocorreu ao clonar o arquivo base do controller');
            return;
        }
        fclose($f);
        Cli::println("{$name} criado em 'App/Controllers' com sucesso.");
        Debug::log("{$name} criado em 'App/Controllers' com sucesso.");
    }

    public static function execOptionMakeControllerResource()
    {
        Cli::println("Você optou por criar um ResourceController.");
        $name = Cli::getParam('Por favor, DIGITE o nome do ResourceController a ser criado');
        $routeName = $name;
        $name = ucfirst($name);
        $name = $name . "Controller";
        if (file_exists("App/Controllers/$name.php")) {
            Cli::println("ERROR: Controller " . $name . " já existente na pasta 'App/Controllers'");
            Debug::log("ERROR: Controller " . $name . " já existente na pasta 'App/Controllers'");
            return;
        }
        $content = file_get_contents('System/Shell/templates/php_tpl/resourceControllerFile.tpl');
        $content = strtr($content, [
            'dateNow' => date('d-m-y - H:i:a'),
            '$name' => $name
        ]);
        $routeResource = file_get_contents('System/Shell/templates/php_tpl/routesResourceFile.tpl');
        $routeResource = strtr($routeResource, [
            'dateNow' => date('d-m-y - H:i:a'),
            '$name' => $name,
            '$routeName' => $routeName
        ]);
        $f = fopen("App/Controllers/$name.php", 'w+');
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            Debug::log('Um erro desconhecido ocorreu ao ler o arquivo base do controller');
            return;
        }
        $fw = fwrite($f, $content);
        if ($fw == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            Debug::log('Um erro desconhecido ocorreu ao clonar o arquivo base do controller');
            return;
        }
        fclose($f);
        Cli::println("{$name} criado em 'App/Controllers' com sucesso.");
        Debug::log("{$name} criado em 'App/Controllers' com sucesso.");
        $f = fopen("App/Routes/web.php", 'a+');
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            Debug::log('Um erro desconhecido ocorreu ao ler o arquivo de rotas do controller resource');
            return;
        }
        $fw = fwrite($f, $routeResource);
        if ($fw == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            Debug::log('Um erro desconhecido ocorreu ao clonar o arquivo de rotas do controller resource');
            return;
        }
        fclose($f);
        Cli::println("Rotas do controller {$name} criadas em 'App/Routes/web.php' com sucesso.");
        Debug::log("Rotas do controller {$name} criadas em 'App/Routes/web.php' com sucesso.");
    }

    public static function execOptionMakeControllerApiResource()
    {
        Cli::println("Você optou por criar um ResourceApiController.");
        $name = Cli::getParam('Por favor, DIGITE o nome do ResourceApiController a ser criado');
        $routeName = $name;
        $name = ucfirst($name);
        $name = $name . "Controller";
        if (file_exists("App/Controllers/$name.php")) {
            Cli::println("ERROR: Controller " . $name . " já existente na pasta 'App/Controllers'");
            Debug::log("ERROR: Controller " . $name . " já existente na pasta 'App/Controllers'");
            return;
        }
        $content = file_get_contents('System/Shell/templates/php_tpl/resourceApiControllerFile.tpl');
        $content = strtr($content, [
            'dateNow' => date('d-m-y - H:i:a'),
            '$name' => $name
        ]);
        $routeResource = file_get_contents('System/Shell/templates/php_tpl/routesApiResourceFile.tpl');
        $routeResource = strtr($routeResource, [
            'dateNow' => date('d-m-y - H:i:a'),
            '$name' => $name,
            '$routeName' => $routeName
        ]);
        $f = fopen("App/Controllers/$name.php", 'w+');
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            Debug::log('Um erro desconhecido ocorreu ao ler o arquivo base do controller');
            return;
        }
        $fw = fwrite($f, $content);
        if ($fw == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            Debug::log('Um erro desconhecido ocorreu ao clonar o arquivo base do controller');
            return;
        }
        fclose($f);
        Cli::println("{$name} criado em 'App/Controllers' com sucesso.");
        $f = fopen("App/Routes/api.php", 'a+');
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            Debug::log('Um erro desconhecido ocorreu ao ler o arquivo de rotas');
            return;
        }
        $fw = fwrite($f, $routeResource);
        if ($fw == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            Debug::log('Um erro desconhecido ocorreu ao clonar o arquivo de rotas');
            return;
        }
        fclose($f);
        Cli::println("Rotas do controller {$name} criadas em 'App/Routes/api.php' com sucesso.");
        Debug::log("Rotas do controller {$name} criadas em 'App/Routes/api.php' com sucesso.");
    }
}
