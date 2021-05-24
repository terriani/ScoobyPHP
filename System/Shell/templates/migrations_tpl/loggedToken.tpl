<?php

// Migration criada - Via Scooby_CLI em dateNow

use Phinx\Migration\AbstractMigration;

class LoggedTokens extends AbstractMigration
{
    /*
     *
     * @return void
     */
    public function change(): void
    {
        $this->Table('logged_tokens')
        ->addColumn('token', 'string', ['null' => false])
        ->addColumn('user_agent', 'string', ['null' => true])
        ->addColumn('created_at', 'datetime', ['null' => false])
        ->addColumn('user_id', 'integer', ['null' => false])
        ->addColumn('ip', 'string', ['null' => false])
        ->addColumn('app_key', 'string', ['null' => false])
        ->addColumn('logged_id', 'string', ['null' => false])
        ->create();
    }
}
