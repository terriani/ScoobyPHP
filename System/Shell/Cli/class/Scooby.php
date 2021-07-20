<?php

use Scooby\Kernel\Cli;

class Scooby
{
    public static function do()
    {
        $date = date('d-m-y - //H:i:a');
        self::showHeader();
        do {
            self::showHeaderOption();
            $component = Cli::getParam("\033[1;32m Aguardando a opção escolhida... \033[1;97m");
            $component = strtolower($component);
            if ($component == 'make:file' or $component == 'makefile') {
                MakeFile::execOptionMakeFile();
            } elseif ($component == 'make:controller' or $component == 'makecontroller') {
                MakeController::execOptionMakeController();
            } elseif (
                $component == 'make:controller -r' or $component == 'makecontroller -r'
                or $component == 'make:controller --resource' or $component == 'makecontroller --resource'
            ) {
                MakeController::execOptionMakeControllerResource();
            } elseif (
                $component == 'make:controller -r --api' or $component == 'makecontroller -r'
                or $component == 'make:controller --resource --api' or $component == 'makecontroller --resource'
            ) {
                MakeController::execOptionMakeControllerApiResource();
            } elseif (
                $component == 'make:model' or
                $component == 'makemodel'
            ) {
                MakeModel::execOptionMakeModel();
            } elseif (
                $component == 'makemodel -m' or
                $component == 'make:model -m' or
                $component == 'makemodel --migration' or
                $component == 'make:model --migration'
            ) {
                MakeModel::execOptionMakeModelMigration();
            } elseif (
                $component == 'make:model -m -s' or
                $component == 'makemodel -m -s' or
                $component == 'make:model --migration --seed' or
                $component == 'makemodel --migration --seed'
            ) {
                MakeModel::execOptionMakeModelMigrationAndSeed();
            } elseif ($component == 'make:component' or $component == 'makecomponent') {
                MakeComponent::execOptionMakeComponent();
            } elseif (
                $component == 'make:view' or
                $component == 'makeview'
            ) {
                MakeView::execOptionMakeView();
            } elseif (
                $component == 'make:view -a' or
                $component == 'makeview -a'
            ) {
                MakeView::execOptionMakeViewAuth();
            } elseif (
                $component == 'newdb' or
                $component == 'new:db'
            ) {
                MakeNewDb::execOptionMakeNewDb();
            } elseif (
                $component == 'make:react-app' or
                $component == 'makereact-app'
            ) {
                MakeReactApp::execOptionMakeReactApp();
            } elseif (
                $component == 'clear:cache' or
                $component == 'clearcache'
            ) {
                MakeClearCache::execOptionMakeClearCache();
            } elseif (
                $component == 'make:migration' or
                $component == 'makemigration'
            ) {
                MakeMigration::execOptionMakeMigration();
            } elseif (
                $component == 'migrate' or
                $component == 'MIGRATE' or
                $component == 'Migrate'
            ) {
                $migrate = shell_exec("php vendor/robmorgan/phinx/bin/phinx migrate");
                if (!$migrate) {
                    Cli::println("Ocorreu um erro inesperado, por favor tente novamente.");
                    return;
                }
                Cli::println("Migrate executada com sucesso.");
            } elseif (
                $component == 'rollback' or
                $component == 'ROLLBACK' or
                $component == 'Rollback'
            ) {
                $rollback = shell_exec("php vendor/robmorgan/phinx/bin/phinx rollback");
                if (!$rollback) {
                    Cli::println("Ocorreu um erro inesperado, por favor tente novamente.");
                    return;
                }
                Cli::println("Rollback executado com sucesso.");
            } elseif (
                $component == 'makeseed' or
                $component == 'make:seed'
            ) {
                MakeSeed::execOptionMakeSeed();
            } elseif (
                $component == 'runSeed' or
                $component == 'run:seed'
            ) {
                $seedName = Cli::getParam('Por favor, DIGITE o nome da Seed a ser executada. Use o mesmo formato dado ao nome do arquivo');
                $seedName = ucfirst($seedName);
                chdir('App/Db/Seeds/');

                shell_exec('php ' . $seedName . '.php');

                Cli::println("Seed {$seedName} executada com sucesso em App/Db/Seeds/");
            } elseif (
                $component == 'makeauth' or
                $component == 'make:auth'
            ) {
                $api = Cli::getParam('Seu projeto é uma API ?  Digite: [ y ] Sim || [ n ] Não');
                if ($api == 'y' or $api == 'Y') {
                    MakeAuth::execOptionMakeAuthApi();
                } elseif ($api == 'n' or $api == 'N') {
                    MakeAuth::execOptionMakeAuth();
                } else {
                    Cli::println('O valor digitado [ ' . $api . ' ] é Inválido');
                    Cli::println('Autenticação de usuário não pode ser criada. Por favor tente novamente');
                    exit;
                }
            } elseif (
                $component == 'makeauth --api' or
                $component == 'make:auth --api' or
                $component == 'makeauth -api' or
                $component == 'make:auth -api'
            ) {
                MakeAuth::execOptionMakeAuthApi();
            }elseif (
                $component == 'makemiddleware' or
                $component == 'make:middleware'
            ) {
                MakeMiddleware::execOptionMakeMiddleware();
            } elseif (
                $component == 's' or
                $component == 'S' or
                $component == 'sair' or $component == 'Sair'
            ) {
                Cli::println("\033[1;91m Operação cancelada pelo usuário! \033[1;97m");
                return;
            } else {
                Cli::println("\033[1;91m Opção inválida \033[1;97m");
                return;
            }
            Cli::println(
                "
        ----------------------------------------
        |          DESEJA CONTINUAR ?          |
        |--------------------------------------|
        | DIGITE: 'Y' Para continuar           |
        | DIGITE: 'N' para cancelar a operação |
        ----------------------------------------
        "
            );
            $component = Cli::getParam(
                " \033[1;32m Digite a opção desejada \033[1;97m"
            );
        } while (
            $component == 'y' or
            $component == 'Y' or
            $component == 'yes' or
            $component == 'YES' or
            $component == 'Yes'
        );
        if (
            $component == 'n' or
            $component == 'N' or
            $component == 'No' or $component == 'Sair'
        ) {
            Cli::println("\033[1;91m Operação cancelada pelo usuário! \033[1;97m");
            return;
        } else {
            Cli::println("\033[1;91m Opção inválida \033[1;97m");
            return;
        }
    }

    private static function showHeader()
    {
        Cli::println(PHP_EOL . "\033[1;90m
    ____                  _                      ____ _     ___
   / ___|  ___ ___   ___ | |__  _   _           / ___| |   |_ _|
   \___ \ / __/ _ \ / _ \| '_ \| | | |  _____  | |   | |    | |
    ___) | (_| (_) | (_) | |_) | |_| | |_____| | |___| |___ | |
   |____/ \___\___/ \___/|_.__/ \__, |          \____|_____|___|
                                |___/
    \033[1;97m");
    }

    private static function showHeaderOption()
    {
        Cli::println("
    \033[1;32m *** Bem vindo ao Scooby CLI *** \033[1;97m
    \033[4;32m
COMANDOS DISPONÍVEIS: \033[;97m

  \033[1;90m - DIGITE: \033[;97m 'new:db' para criar um novo banco
  \033[1;90m - DIGITE: \033[;97m 'make:migration' para criar uma migration
  \033[1;90m - DIGITE: \033[;97m 'migrate' para executar as migration criadas
  \033[1;90m - DIGITE: \033[;97m 'Rollback' para executar um Rollback na migration criada
  \033[1;90m - DIGITE: \033[;97m 'make:seed' para criar uma Seed no Banco de dados
  \033[1;90m - DIGITE: \033[;97m 'Run:Seed' para executar uma Seed no Banco de dados
  \033[1;90m - DIGITE: \033[;97m 'make:controller' para criar um Controller
  \033[1;90m - DIGITE: \033[;97m 'make:controller -r' ou make:controller --resource para criar um
  ResourceController
  \033[1;90m - DIGITE: \033[;97m 'make:model' para criar um Model
  \033[1;90m - DIGITE: \033[;97m 'make:model -m' ou make:model --migration para criar um model
  com uma respectiva migration
  \033[1;90m - DIGITE: \033[;97m 'make:model -m -s' make:model --migration --seed para criar
  um model com uma respectiva migration e uma respectiva seed
  \033[1;90m - DIGITE: \033[;97m 'make:component' para criar um Componente
  \033[1;90m - DIGITE: \033[;97m 'make:view' para criar uma View
  \033[1;90m - DIGITE: \033[;97m 'make:view -a' para criar uma View autenticada
  \033[1;90m - DIGITE: \033[;97m 'make:file' para criar um Arquivo
  \033[1;90m - DIGITE: \033[;97m 'Clear:Cache para apagar os arquivos de cache do twig
  \033[1;90m - DIGITE: \033[;97m 'make:auth' para criar uma rotina de cadastro e login
  \033[1;90m - DIGITE: \033[;97m 'make:auth --api' para criar uma rotina de cadastro e login via api
  \033[1;90m - DIGITE: \033[;97m 'make:react-app' para criar uma estrutura ReactJs
  \033[1;90m - DIGITE: \033[;97m 'make:middleware' para criar um Middleware
");
    }
}
