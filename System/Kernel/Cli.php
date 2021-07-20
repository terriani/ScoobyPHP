<?php

namespace Scooby\Kernel;

/**
 * Ajuda com tarefas rotieniras do CLI
 */
class Cli
{
    /**
     * mostra uma mensagem iniando em uma nova linha
     *
     * @param string $msg
     * @return void
     */
    public static function println(string $msg): void
    {
        echo "  ".$msg.PHP_EOL;
    }

    /**
     * Mostra uma mensagem e espera um parametro de entrada
     *
     * @param string $msg
     * @return string
     */
    public static function getParam(string $msg): string
    {
        echo "  ".$msg.PHP_EOL."\033[1;32m -> \033[;97m";
        $param = fgets(STDIN);
        $param = trim($param);
        return $param;
    }
}
