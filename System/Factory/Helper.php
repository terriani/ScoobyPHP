<?php

namespace Scooby\Factory;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Collection as LaravelCollections;
use Scooby\Database\IlluminateDatabase;
use Scooby\Database\PDODatabase;

class Helper
{
    /**
     * Metodo que instancia a classe externa Carbon
     */
    public static function date()
    {
        return new Carbon;
    }

    /**
     * Metodo que instancia a classe IlluminateDatabase
     */
    public static function illuminateDb()
    {
        return new IlluminateDatabase;
    }


    /**
     * Metodo que instancia a classe PDODatabase
     */
    public static function pdoDb()
    {
        return new PDODatabase;
    }

    /**
     * Método qeu instancia collections
     *
     * @param array $items
     * @param string $support
     * @return LaravelCollections
     */
    public static function create($items = [])
    {
       return new LaravelCollections($items);
    }
}
