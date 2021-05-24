<?php

// Migration criada - Via Scooby_CLI em dateNow

use Phinx\Migration\AbstractMigration;

class migrationName extends AbstractMigration
{
    /*
     *
     * @return void
     */
    public function change(): void
    {
        $this->Table('table_name')

        // Adicione colunas à tabela com o método addColum, passando p nome da coluna
        // o tipo do dado e um array com opções como no exemplo abaixo:
        // ->addColumn('name', 'string', ['null' => false])

        ->create();
    }
}
