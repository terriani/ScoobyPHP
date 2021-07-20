<?php

use Scooby\Kernel\Cli;
use Scooby\Log\Log;

class MakeModel
{
    public static function execOptionMakeModel()
    {
        Cli::println("Você optou por criar um Model.");
        $name = Cli::getParam('Por favor, DIGITE o nome do Model a ser criado');
        $name = ucfirst($name);
        if (file_exists("App/Models/$name.php")) {
            Cli::println("ERROR: Model já existente na pasta 'App/Models'");
            Log::log("ERROR: Model $name já existente na pasta 'App/Models'");
            return;
        }
        $content = file_get_contents('System/Shell/templates/php_tpl/modelFile.tpl');
        $content = strtr($content, [
            'dateNow' => date('d-m-y - H:i:a'),
            '$name' => $name
        ]);
        $f = fopen("App/Models/$name.php", 'w+');
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            Log::log('Um erro desconhecido ocorreu na leitura do model ' . $name . ', por favor tente novamente');
            return;
        }
        $fw = fwrite($f, $content);
        if ($fw == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            Log::log('Um erro desconhecido ocorreu na escrita do model ' . $name . ', por favor tente novamente');
            return;
        }
        fclose($f);
        Cli::println("$name criado em 'App/Models' com sucesso.");
        Log::log("$name criado em 'App/Models' com sucesso.");
    }

    public static function execOptionMakeModelMigration()
    {
        Cli::println("Você optou por criar um Model.");
        $name = Cli::getParam('Por favor, DIGITE o nome do Model a ser criado');
        $name = ucfirst($name);
        $migrationName = $name;
        if (file_exists("App/Models/$name.php")) {
            Cli::println("ERROR: Model já existente na pasta 'App/Models'");
            Log::log("ERROR: Model $name já existente na pasta 'App/Models'");
            return;
        }
        $content = file_get_contents('System/Shell/templates/php_tpl/modelFile.tpl');
        $content = strtr($content, [
            'dateNow' => date('d-m-y - H:i:a'),
            '$name' => $name
        ]);
        $f = fopen("App/Models/$name.php", 'w+');
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            Log::log('Um erro desconhecido ocorreu na leitura do model ' . $name . ', por favor tente novamente');
            return;
        }
        $fw = fwrite($f, $content);
        if ($fw == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            Log::log('Um erro desconhecido ocorreu na escrita do model ' . $name . ', por favor tente novamente');
            return;
        }
        fclose($f);
        Cli::println("$name criado em 'App/Models' com sucesso.");

        $convertName = ltrim(strtolower(preg_replace('/[A-Z]/', '_$0', $migrationName)), '_');
        $fileName = date('YmdHis') . "_" . $convertName;

        if (file_exists("App/Db/Migrations/$fileName.php")) {
            Cli::println("ERROR: Migration já existente na pasta 'App/Db/Migrations/'");
            Log::log("ERROR: Migration $migrationName já existente na pasta 'App/Db/Migrations/'");
            return;
        }
        $migration = file_get_contents('System/Shell/templates/migrations_tpl/migration.tpl');
        $migration = strtr($migration, [
            'migrationName' => $migrationName,
            'dateNow' => date('d-m-y - H:i:a')
        ]);
        $f = fopen('App/Db/Migrations/' . $fileName . '.php', 'w+');
        fwrite($f, $migration);
        fclose($f);
        if (!$f) {
            Cli::println("Ocorreu um erro inesperado, por favor tente novamente.");
            Log::log('Um erro desconhecido ocorreu na escrita da migration ' . $migrationName . ', por favor tente novamente');
            return;
        }
        Cli::println("Migration $migrationName criada com sucesso em App/Db/Migrations/");
        Log::log("Migration $migrationName criada com sucesso em App/Db/Migrations/");
        Log::log("$name criado em 'App/Models' com sucesso.");
    }

    public static function execOptionMakeModelMigrationAndSeed()
    {
        Cli::println("Você optou por criar um Model.");
        $name = Cli::getParam('Por favor, DIGITE o nome do Model a ser criado');
        $name = ucfirst($name);
        $migrationName = $name;
        $seedName = $name . "Seed";
        if (file_exists("App/Models/$name.php")) {
            Cli::println("ERROR: Model já existente na pasta 'App/Models'");
            Log::log("ERROR: Model $name já existente na pasta 'App/Models'");
            return;
        }
        $content = file_get_contents('System/Shell/templates/php_tpl/modelFile.tpl');
        $content = strtr($content, [
            'dateNow' => date('d-m-y - H:i:a'),
            '$name' => $name
        ]);
        $f = fopen("App/Models/$name.php", 'w+');
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            Log::log('Um erro desconhecido ocorreu na leitura do model ' . $name . ', por favor tente novamente');
            return;
        }
        $fw = fwrite($f, $content);
        if ($fw == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            Log::log('Um erro desconhecido ocorreu na escrita do model ' . $name . ', por favor tente novamente');
            return;
        }
        fclose($f);
        Cli::println("$name criado em 'App/Models' com sucesso.");
        if (file_exists("App/Db/Migrations/$migrationName.php")) {
            Cli::println("ERROR: Migration já existente na pasta 'App/Db/Migrations/'");
            Log::log("ERROR: Migration $migrationName já existente na pasta 'App/Db/Migrations/'");
            return;
        }
        $migration = file_get_contents('System/Shell/templates/migrations_tpl/migration.tpl');
        $migration = strtr($migration, [
            'migrationName' => $migrationName."CreateTable",
            'dateNow' => date('d-m-y - H:i:a')
        ]);
        $f = fopen('App/Db/Migrations/' . $migrationName . '.php', 'w+');
        fwrite($f, $migration);
        fclose($f);
        if (!$f) {
            Cli::println("Ocorreu um erro inesperado, por favor tente novamente.");
            Log::log('Um erro desconhecido ocorreu na leitura da migration ' . $migrationName . ', por favor tente novamente');

            return;
        }
        Cli::println("Migration $migrationName criada com sucesso em App/Db/Migrations/");
        if (file_exists("App/Db/Seeds/$seedName.php")) {
            Cli::println("ERROR: Seed já existente na pasta 'App/Db/Seeds/'");
            Log::log("ERROR: Seed $seedName já existente na pasta 'App/Db/Seeds/'");
            return;
        }
        $seed = file_get_contents('System/Shell/templates/seeds_tpl/seedFile.tpl');
        $seed = strtr($seed, [
            'dateNow' => date('d-m-y - H:i:a'),
            'users' => strtolower($name) . "s",
        ]);
        $f = fopen("App/Db/Seeds/$seedName.php", 'w+');
        if ($f == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            Log::log('Um erro desconhecido ocorreu na leitura da seed ' . $seedName . ', por favor tente novamente');
            return;
        }
        $fw = fwrite($f, $seed);
        if ($fw == false) {
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            Log::log('Um erro desconhecido ocorreu na escrita da seed ' . $seedName . ', por favor tente novamente');
            return;
        }
        fclose($f);
        Cli::println("Seed {$seedName}Seed criada com sucesso em App/Db/Seeds/");
        Log::log("Seed {$seedName}Seed criada com sucesso em App/Db/Seeds/");
        Log::log("Migration $migrationName criada com sucesso em App/Db/Migrations/");
        Log::log("$name criado em 'App/Models' com sucesso.");
    }
}
