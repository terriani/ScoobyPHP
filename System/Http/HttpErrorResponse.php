<?php

namespace Scooby\Http;

use Scooby\I18n\I18n;

class HttpErrorResponse
{
    /**
     * Retorna um inteiro com o código do erro http
     *
     * @return integer
     */
    public static function httpGetErrorCode(): int
    {
        return $_SESSION['httpCode'] ?? 0;
    }

    /**
     * Recebe o código de erro http e retorna uma string com sua determinada menssagem
     *
     * @param string $errorCode
     * @return string
     */
    public static function httpGetErrorMsg(): string
    {
        return I18n::translate('status_code', $_SESSION['httpCode']) ?? I18n::translate('error', 'UNKNOWN_ERROR');
    }
}
