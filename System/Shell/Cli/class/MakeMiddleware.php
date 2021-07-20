<?php

use Scooby\Kernel\Cli;
use Scooby\Log\Log;

class MakeMiddleware
{
    public static function execOptionMakeMiddleware()
    {
        Cli::println("Você optou por criar um Middleware.");
        $name = Cli::getParam('Por favor, DIGITE o nome do Middleware a ser criado');
        $name = ucfirst($name);
        $name = $name. "Middleware";
        if (file_exists("App/Middlewares/$name.php")) {
            Cli::println("ERROR: Componente ". $name . " já existente na pasta 'App/Components'");
            Log::log("ERROR: Componente " . $name . " já existente na pasta 'App/Components'");
            return;
        }
        $content = file_get_contents('System/Shell/templates/php_tpl/middlewareFile.tpl');
        $content = strtr($content, [
            'dateNow' => date('d-m-y - H:i:a'),
            '$name' => $name
        ]);
        $f = fopen("App/Middlewares/$name.php", 'w+');
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            Log::log('Um erro desconhecido ocorreu ao ler o arquivo base de middlewares');
            return;
        }
        $fw = fwrite($f, $content);
        if ($fw == false) {
            Log::log('Um erro desconhecido ocorreu ao clonar o arquivo base de middlewares');
            return;
        }
        fclose($f);
        Cli::println("{$name} criado em 'App/Middlewares' com sucesso.");
        Log::log("{$name} criado em 'App/Middlewares' com sucesso.");
    }
}