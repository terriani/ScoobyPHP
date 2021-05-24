<?php

// Migration criada - Via Scooby_CLI em dateNow

use Phinx\Migration\AbstractMigration;

class CreateUserAuth extends AbstractMigration
{
    /**
     * Migration criada - Via Scooby_CLI.
     */
    public function change(): void
    {
        $this->Table('users')
        ->addColumn('name', 'string', ['null' => false])
        ->addColumn('email', 'string', ['null' => false])
        ->addColumn('password', 'string', ['null' => false])
        ->create();
    }

}
