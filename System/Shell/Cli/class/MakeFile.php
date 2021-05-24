<?php

use Scooby\Helpers\Cli;
use Scooby\Helpers\Debug;

class MakeFile
{
    public static function execOptionMakeFile()
    {
        Cli::println('Você optou por criar um Arquivo.');
        $ext = Cli::getParam('Por favor, DIGITE a extensão do Arquivo a ser criado');
        $ext = strtolower($ext);
        $name = Cli::getParam('Por favor, DIGITE o nome do Arquivo a ser criado');
        $name = strtolower($name);
        $path = Cli::getParam('Por favor, DIGITE o caminho do arquivo a ser criado');
        if (file_exists(__DIR__ . "/$path/$name.$ext")) {
            Cli::println("ERROR: Arquivo já existente na pasta '$path'");
            Debug::log("ERROR: Arquivo $name já existente na pasta '$path'");
            return;
        }
        $content = null;
        if ($ext == 'php') {
            $content = file_get_contents('System/Shell/templates/php_tpl/phpFile.tpl');
        } elseif ($ext == 'html') {
            $content = file_get_contents('System/Shell/templates/html_tpl/htmlFile.tpl');
        } elseif ($ext == 'css') {
            $content = file_get_contents('System/Shell/templates/css_tpl/cssFile.tpl');
        } elseif ($ext == 'txt') {
            $content = file_get_contents('System/Shell/templates/txt_tpl/txtFile.tpl');
        } elseif ($ext == 'js') {
            $content = file_get_contents('System/Shell/templates/js_tpl/jsFile.tpl');
        }
        $content = strtr((string) $content, ['dateNow' => date('d-m-y - H:i:a')]);
        $f = fopen("$path/$name.$ext", 'w+');
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            Debug::log('Um erro desconhecido ocorreu na leitura do arquivo ' . $name . ', por favor tente novamente');
            return;
        }
        $fw = fwrite($f, $content);
        if ($fw == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            Debug::log('Um erro desconhecido ocorreu na escrita do arquivo ' . $name . ', por favor tente novamente');
            return;
        }
        fclose($f);
        Cli::println("$name.$ext criado em '$path/' com sucesso.");
        Debug::log("$name.$ext criado em '$path/' com sucesso.");
    }
}
