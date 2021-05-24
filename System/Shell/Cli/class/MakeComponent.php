<?php

use Scooby\Helpers\Cli;
use Scooby\Helpers\Debug;

class MakeComponent
{
    public static function execOptionMakeComponent()
    {
        Cli::println("Você optou por criar um Componente.");
        $name = Cli::getParam('Por favor, DIGITE o nome do Componente a ser criado');
        $name = ucfirst($name);
        $name = $name. "Component";
        if (file_exists("App/Components/$name.php")) {
            Cli::println("ERROR: Componente ". $name . " já existente na pasta 'App/Components'");
            Debug::log("ERROR: Componente " . $name . " já existente na pasta 'App/Components'");
            return;
        }
        $content = file_get_contents('System/Shell/templates/php_tpl/componentFile.tpl');
        $content = strtr($content, [
            'dateNow' => date('d-m-y - H:i:a'),
            '$name' => $name
        ]);
        $f = fopen("App/Components/$name.php", 'w+');
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            Debug::log('Um erro desconhecido ocorreu ao ler o arquivo base de components');
            return;
        }
        $fw = fwrite($f, $content);
        if ($fw == false) {
            Debug::log('Um erro desconhecido ocorreu ao clonar o arquivo base de components');
            return;
        }
        fclose($f);
        Cli::println("{$name} criado em 'App/Components' com sucesso.");
        Debug::log("{$name} criado em 'App/Components' com sucesso.");
    }
}