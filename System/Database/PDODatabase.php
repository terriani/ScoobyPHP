<?php

namespace Scooby\Database;

class PDODatabase
{
    /**
     * Construtor da classe abre conexão com banco de dados
     */
    public $db;

    /**
     * Metodo construtor da classe
     */
    public function __construct()
    {
        global $db;
        $this->db = $db;
    }
}
