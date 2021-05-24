<?php

namespace Scooby\Helpers;

use Cake\Collection\Collection as CakeCollections;
use Exception;
use Illuminate\Support\Collection as LaravelCollections;

class Collections
{
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
        $instance = null;
        if (in_array(strtolower($support), $illuminate)) {
            $instance = new LaravelCollections($items);
        } else if (in_array(strtolower($support), $cake)) {
            $instance = new CakeCollections($items);
        } else {
            throw new Exception("Collections [ " . strtoupper($support) . " ] not supported", 1);

        }
        return $instance;
    }
}