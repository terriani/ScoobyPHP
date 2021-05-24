<?php

namespace Scooby\Helpers;

class Redirect
{

    /**
     * Executa um redirecionamento para a url indicada
     *
     * @param string $url
     * @return void
     */
    public static function redirectTo(string $url): void
    {
        header("Location:$url");
    }

    /**
     * Retorna a quantidade de paginas informada no metodo
     * caso não seja informado um valor, retorna para a pagina anterior
     *
     * @param integer $value
     * @return void
     */
    public static function redirectBack(int $value = -1): void
    {
        echo "<script>window.history.go($value)</script>";
    }
}
