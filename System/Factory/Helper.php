<?php

namespace Scooby\Factory;

use Carbon\Carbon;
use Cake\Collection\Collection as CakeCollections;
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
     * @return void
     */
    public static function create($items = [], $support = COLLECTIONS_SUPPORT)
    {
        $illuminate = [
            'laravel',
            'illuminate',
            'iluminate\support',
            'illuminate\support\collection',
            '\iluminate\support\\',
            '\illuminate\support\collection\\'
        ];
        $cake = [
            'cake',
            'cakephp',
            'cake php',
            'cake\collection',
            'Cake\Collection\Collection',
            'cake\collection\\',
            'Cake\Collection\Collection\\'
        ];
        if (in_array(strtolower($support), $illuminate)) {
            return new LaravelCollections($items);
        } else if (in_array(strtolower($support), $cake)) {
            return new CakeCollections($items);
        }
        throw new Exception("Collections [ " . strtoupper($support) . " ] not supported", 1);
    }
}
