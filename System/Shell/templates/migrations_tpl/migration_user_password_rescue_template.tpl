<?php

// Migration criada - Via Scooby_CLI em dateNow

use Phinx\Migration\AbstractMigration;

class PasswordRescue extends AbstractMigration
{
    /**
     * Migration criada - Via Scooby_CLI.
     */
    public function change(): void
    {
        $this->Table('password_user_tokens')
        ->addColumn('user_id', 'integer', ['null' => false])
        ->addColumn('token', 'string', ['null' => false])
        ->addColumn('used', 'string', ['null' => false])
        ->create();
    }

}
