<?php

namespace Scooby\Core;

use Illuminate\Database\Capsule\Manager as db;
use Illuminate\Database\Eloquent\Model as IlluminateModel;
use Scooby\Helpers\Debug;

abstract class Model extends IlluminateModel
{
    //Seta o Timestamps do eloquent para FALSE
    //caso queira utilizalo mude o valor para TRUE
    public $timestamps = false;

    /**
     * Metodo construtor da classe
     */
    public function __construct()
    {
        require_once 'System/SysConfig/illuminateConfig.php';
        require_once 'System/SysConfig/PDOConfig.php';
    }

    /**
     * Cria um arquivo de debug
     *
     * @param mixed $data
     * @param string $msg
     * @param string $logName
     * @return void
     */
    public function debug($data, $msg = '', $logName = 'debug.log')
    {
        Debug::debug($data, $msg, $logName);
    }
}
