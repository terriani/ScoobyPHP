<?php

use Scooby\Kernel\Cli;
use Scooby\Log\Log;

class MakeMigration
{
    public static function execOptionMakeMigration()
    {
        $migrationName = Cli::getParam('Por favor, DIGITE o nome da Migration a ser criada. Use o formato CamelCase');
        $migrationName = ucfirst($migrationName);

        $convertName = ltrim(strtolower(preg_replace('/[A-Z]/', '_$0', $migrationName)), '_');
        $fileName = date('YmdHis') . "_" . $convertName;

        if (file_exists("App/Db/Migrations/$fileName.php")) {
            Cli::println("ERROR: Migration já existente na pasta 'App/Db/Migrations/'");
            Log::log("ERROR: Migration $fileName já existente na pasta 'App/Db/Migrations/'");
            return;
        }
        $migration = file_get_contents('System/Shell/templates/migrations_tpl/migration.tpl');
        $migration = strtr($migration, [
            'migrationName' => $migrationName,
            'dateNow' => date('d-m-y - H:i:a')
        ]);
        $f = fopen('App/Db/Migrations/' . $fileName . '.php', 'w+');
        $fw = fwrite($f, $migration);
        fclose($fw);
        if (!$f) {
            Cli::println("Ocorreu um erro inesperado, por favor tente novamente.");
            Log::log("Ocorreu um erro inesperado ao tentar criar a migration $fileName, por favor tente novamente.");
            return;
        }

        Cli::println("Migration $migrationName criada com sucesso em App/Db/Migrations/");
        Log::log("Migration $migrationName criada com sucesso em App/Db/Migrations/");
    }
}
