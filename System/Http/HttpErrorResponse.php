<?php

namespace Scooby\Http;

class HttpErrorResponse
{
    /**
     * Retorna um inteiro com o código do erro http
     *
     * @return integer
     */
    public static function httpGetErrorCode(): int
    {
        if (in_array($_SESSION['httpCode'], array_keys($GLOBALS))) {
            $code = $_SESSION['httpCode'];
        } else {
            $code = 0;
        }
        return $code;
    }

    /**
     * Recebe o código de erro http e retorna uma string com sua determinada menssagem
     *
     * @param string $errorCode
     * @return string
     */
    public static function httpGetErrorMsg(): string
    {
        if (in_array($_SESSION['httpCode'], array_keys($GLOBALS))) {
            $code = $GLOBALS[$_SESSION['httpCode']];
        } else {
            $code = $GLOBALS['UNKNOWN_ERROR'];
        }
        return $code;
    }
}
