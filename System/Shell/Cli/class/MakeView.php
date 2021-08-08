<?php

use Scooby\Kernel\Cli;
use Scooby\Log\Log;

class MakeView
{
    public static function execOptionMakeView()
    {
        Cli::println("Você optou por criar uma View.");
        $name = Cli::getParam('Por favor, DIGITE o nome da View a ser criada');
        $name = ucfirst($name);
        if (file_exists("App/Views/Pages/$name.twig")) {
            Cli::println("ERROR: View já existente na pasta 'App/Views/Pages'");
            Log::log("ERROR: View $name já existente na pasta 'App/Views/Pages'");
            return;
        }
        $content = file_get_contents('System/Shell/templates/twig_tpl/viewFile.tpl');
        $content = strtr($content, [
            'dateNow' => date('d-m-y - H:i:a'),
            '$name' => $name
        ]);
        $f = fopen("App/Views/Pages/$name.twig", 'w+');
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            Log::log('Um erro desconhecido ocorreu na leitura da view ' . $name . ', por favor tente novamente');
            return;
        }
        $fw = fwrite($f, $content);
        if ($fw == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            Log::log('Um erro desconhecido ocorreu na escrita da view ' . $name . ', por favor tente novamente');
            return;
        }
        fclose($f);
        Cli::println("$name criado em 'App/Views/Pages' com sucesso.");
        Log::log("$name criado em 'App/Views/Pages' com sucesso.");
    }

    public static function execOptionMakeViewAuth()
    {
        Cli::println("Você optou por criar uma View.");
        $name = Cli::getParam('Por favor, DIGITE o nome da View a ser criada');
        $name = ucfirst($name);
        if (file_exists("App/Views/Pages/$name.twig")) {
            Cli::println("ERROR: View já existente na pasta 'App/Views/Pages'");
            Log::log("ERROR: View $name já existente na pasta 'App/Views/Pages'");
            return;
        }
        $content = file_get_contents('System/Shell/templates/twig_tpl/viewFile.tpl');
        $content = strtr($content, [
            'dateNow' => date('d-m-y - H:i:a'),
            '$name' => $name
        ]);
        $register = file_get_contents('.env');
        $register = strtr($register, [
            'VIEWS_AUTH=' => 'VIEWS_AUTH=' . $name . ','
        ]);
        $f = fopen("App/Views/Pages/$name.twig", 'w+');
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            Log::log('Um erro desconhecido ocorreu na leitura da view ' . $name . ', por favor tente novamente');
            return;
        }
        $fw = fwrite($f, $content);
        if ($fw == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            Log::log('Um erro desconhecido ocorreu na escrita da view ' . $name . ', por favor tente novamente');
            return;
        }
        fclose($f);
        $f = fopen('.env', 'w+');
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            Log::log('Um erro desconhecido ocorreu na leitura do arquivo .ENV, por favor tente novamente');
            return;
        }
        $fw = fwrite($f, $register);
        if ($fw == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            Log::log('Um erro desconhecido ocorreu na ecrita do arquivo .ENV, por favor tente novamente');
            return;
        }
        fclose($f);
        Cli::println("$name criado em 'App/Views/Pages' com sucesso.");
        Log::log("$name criado em 'App/Views/Pages' com sucesso.");
        Log::log(".ENV alterado com sucesso.");

    }
}
