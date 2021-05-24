<?php

use Scooby\Helpers\Cli;
use Scooby\Helpers\Debug;

class MakeReactApp
{
    public static function execOptionMakeReactApp()
    {
        $appName = APP_NAME;
        if (shell_exec("npx create-react-app react-app --save")) {
            Cli::println("\033[1;96m Front-end gerado com sucesso em ReactJs\n");
            Debug::log("Front-end gerado com sucesso em ReactJs\n");
            sleep(1);
            chdir("react-app");
            Cli::println("Executando servidor, por favor aguarde...\n");
            sleep(1);
            shell_exec('npm start');
            exit;
        }
        Cli::println('Erro ao gerar estrutura front-end em reactJs');
        Debug::log('Erro ao gerar estrutura front-end em reactJs');
    }
}