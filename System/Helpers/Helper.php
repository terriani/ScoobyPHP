<?php

namespace Scooby\Helpers;

use Carbon\Carbon;

class Helper
{
    /**
     * Metodo que instancia a classe externa Carbon
     */
    public function date()
    {
        return new Carbon;
    }

    /**
     * Metodo que instancia a classe IlluminateDatabase
     */
    public function illuminateDb()
    {
        return new IlluminateDatabase;
    }


    /**
     * Metodo que instancia a classe PDODatabase
     */
    public function pdoDb()
    {
        return new PDODatabase;
    }
}
