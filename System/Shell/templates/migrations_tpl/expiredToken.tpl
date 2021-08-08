<?php

// Migration criada - Via Scooby_CLI em dateNow

use Phinx\Migration\AbstractMigration;

class ExpiredToken extends AbstractMigration
{
    /*
     *
     * @return void
     */
    public function change(): void
    {
        $this->Table('expired_tokens')
        ->addColumn('invalid_token', 'string', ['null' => true])
        ->addColumn('user_id', 'integer', ['null' => true])
        ->create();
    }
}
