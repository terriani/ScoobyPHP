<?php

use Scooby\Kernel\Cli;
use Scooby\Log\Log;

class MakeReactApp
{
    public static function execOptionMakeReactApp()
    {
        $appName = APP_NAME;
        if (shell_exec("npx create-react-app react-app --save")) {
            Cli::println("\033[1;96m Front-end gerado com sucesso em ReactJs\n");
            Log::log("Front-end gerado com sucesso em ReactJs\n");
            sleep(1);
            chdir("react-app");
            Cli::println("Executando servidor, por favor aguarde...\n");
            sleep(1);
            shell_exec('npm start');
            exit;
        }
        Cli::println('Erro ao gerar estrutura front-end em reactJs');
        Log::log('Erro ao gerar estrutura front-end em reactJs');
    }
}