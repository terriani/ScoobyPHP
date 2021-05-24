<?php

namespace Scooby\Helpers;

class Debug
{
    /**
     * Grava um arquivo de debug em App/Logs com o nome do arquivo informado
     * caso nenhum nome seja informado o debug será gravado em debug.log
     *
     * @param mixed $data
     * @param string $msg
     * @param string $path
     * @return void
     */
    public static function debug($data, string $msg = '', string $logName = 'debug.log')
    {
        if (!file_exists('App/Logs/' . $logName)) {
            touch('App/Logs/' . $logName, 0777, true);
        }
        if (empty($msg)) {
            $msg = 'Não Informado';
        }
        file_put_contents('App/Logs/' . $logName, "Debug criado em - " . date('Y-m-d H:i:s') . "\n\nObs: " . $msg . "\n\n" . print_r($data, true) . "\n\nEnd Debug \n------------------------------------------------------------------------------------------- \n\n", FILE_APPEND);
    }

    /**
     * Grava um arquivo de Log em App/Logs com o nome do arquivo informado
     * caso nenhum nome seja informado o log será gravado em logs.log
     *
     * @param string $msg
     * @param string $path
     * @return void
     */
    public static function log($msg = '', string $logName = 'logs.log')
    {
        if (getenv('LOG') == 'true') {
            if (!file_exists('App/Logs/' . $logName)) {
                touch('App/Logs/' . $logName, 0777, true);
            }
            if (empty($msg)) {
                $msg = 'Não Informado';
            }
            file_put_contents('App/Logs/' . $logName, "Log criado em - " . date('Y-m-d H:i:s') . "\n\nMessage: " . $msg . "\n\nEnd Log \n------------------------------------------------------------------------------------------- \n\n", FILE_APPEND);
        }
    }
}
