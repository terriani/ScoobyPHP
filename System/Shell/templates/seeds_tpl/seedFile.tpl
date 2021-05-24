<?php

//Seed gerada automaticamente via Scooby_CLI em dateNow
require_once "../../../vendor/autoload.php";

use Scooby\Helpers\Seeders;

$faker = \Faker\Factory::create("pt_BR");

for ($i=0; $i < 10; $i++) {
    $seeder = new Seeders();
    $seeder->seed("tableName", [
        /*
        * Uma lista de todos os valores que a biblioteca faker gera randomicamente
        * pode ser encontrada em:
        * https://faker.readthedocs.io/en/master/providers.html
        * Ducumentação completa da biblioteca faker:
        * https://faker.readthedocs.io/en/master/
        *
        *-----------------------------
        * Exemplo de uso do faker:    |
        *------------------------------
        *
        * 'colunmName' => $faker->name
        *
        */
    ]);
}
