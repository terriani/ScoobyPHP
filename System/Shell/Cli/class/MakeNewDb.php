<?php

use Dotenv\Dotenv;
use Scooby\Kernel\Cli;
use Scooby\Log\Log;

class MakeNewDb
{
    public static function execOptionMakeNewDb()
    {
        require_once 'vendor/autoload.php';
        $dotenv = Dotenv::createImmutable(dirname(-3));
        $dotenv->load();
        Cli::println('Você optou por criar um novo banco de dados.');
        $name = Cli::getParam('Por favor, DIGITE o nome do Banco a ser criada');
        try {
            if (getenv('ENV') == 'development') {
                $conn = new PDO(getenv('DB_DRIVER') . ":host=" . getenv('DB_HOST') . ";charset=utf8", getenv('DB_USER'), getenv('DB_PASS'), [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);
            } elseif (getenv('ENV') == 'production') {
                $conn = new PDO(getenv('PROD_DB_DRIVER') . ":host=" . getenv('PROD_DB_HOST') . ";charset=utf8", getenv('PROD_DB_USER'), getenv('PROD_DB_PASS'), [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);
            }
        } catch (Exception $e) {
            Cli::println('Um erro inesperado ocorreu, por favor tente mais tarde.');
            Log::log("Um erro inesperado ocorreu ao criar o banco de dados $name, \n [ERRO] -> " . $e->getMessage());
            Cli::println('');
            Cli::println($e->getMessage());
            return;
        }
        $test = $conn->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$name'");
        if ($test->fetchColumn()) {
            Cli::println('Opss...: Banco de dados já existente, deseja se conectar a ele ?');
            $connect = Cli::getParam('DIGITE: Y para sim ou N para não');
            if ($connect == 'y' or $connect == 'Y') {
                $dbUser = Cli::getParam('Por favor digite o usuário do banco de dados ' . $name);
                $dbpass = Cli::getParam('por favor digite a senha do usuário do banco de dados ' . $name);
                $connectionUpdate = file_get_contents('.env');
                $connectionUpdate = strtr($connectionUpdate, [
                    "DB_NAME=" =>  "DB_NAME=$name",
                    "DB_USER='root'" =>  "DB_USER=$dbUser",
                    "DB_PASS=" =>  "DB_PASS=$dbpass"
                ]);
                $f = fopen(".env", 'w+');
                if ($f == false) {
                    Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
                    Log::log('Um erro desconhecido ocorreu na leitura do .ENV, por favor tente novamente');
                    return;
                }
                $fw = fwrite($f, $connectionUpdate);
                if ($fw == false) {
                    Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
                    Log::log('Um erro desconhecido ocorreu na escrita do .ENV, por favor tente novamente');
                    return;
                }
                fclose($f);
                Cli::println('Banco de dados ' . $name . ' conectado com sucesso');
                Log::log('Banco de dados ' . $name . ' conectado com sucesso');
            } else {
                Cli::println('Operação cancelada pelo usuário');
                return;
            }
        }

        $create = $conn->query("CREATE DATABASE IF NOT EXISTS $name CHARACTER SET utf8 COLLATE utf8_general_ci;");
        if ($create) {
            Cli::println("BANCO DE DADOS $name Criado com sucess");
            Log::log("BANCO DE DADOS $name Criado com sucess");
            $configDb = file_get_contents('.env');
            $configDb = strtr($configDb, [
                "DB_NAME=" =>  "DB_NAME=$name",

            ]);
            $f = fopen(".env", 'w+');
            if ($f == false) {
                Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
                Log::log('Um erro desconhecido ocorreu na leitura do .ENV, por favor tente novamente');
                return;
            }
            $fw = fwrite($f, $configDb);
            if ($fw == false) {
                Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
                Log::log('Um erro desconhecido ocorreu na escrita do .ENV, por favor tente novamente');
                return;
            }
            fclose($f);
            Cli::println('DB_NAME alterado com sucesso');
            Log::log('DB_NAME alterado com sucesso');
        } else {
            Cli::println("Um erro inesperado ocorreu, por favor tente mais tarde.");
            Log::log("Um erro inesperado ocorreu, por favor tente mais tarde.");
        }
    }
}
