<?php

namespace Scooby\Helpers;

class Cookie
{
    /**
     * Cria um novo cookie
     *
     * @param string $cookieName
     * @param string $cookieValue
     * @param string $expire
     * @return bool
     */
    public static function setCookie(string $cookieName, string $cookieValue, int $expire = 999999): bool
    {
        return setCookie($cookieName, $cookieValue, time() + ($expire));
    }

    /**
     * Cria um cookie sem prazo para expirar
     *
     * @param string $cookieName
     * @param string $cookieValue
     * @return bool
     */
    public static function setCookieForever(string $cookieName, string $cookieValue): bool
    {
        return setCookie($cookieName, $cookieValue);
    }

    /**
     * Retorna o valor do cookie informado
     *
     * @param string $cookieName
     * @return bool
     */
    public static function getCookie(string $cookieName): string
    {
        if (!isset($_COOKIE[$cookieName])) {
            return false;
        }
        return $_COOKIE[$cookieName];
    }

    /**
     * Recupera o valor do cookie e apaga o seu valor
     *
     * @param string $cookieName
     * @return string|bool
     */
    public static function getCookieAndErase($cookieName)
    {
        if (!isset($_COOKIE[$cookieName])) {
            return false;
        }
        echo $_COOKIE[$cookieName];
        return $_COOKIE[$cookieName] = "";
    }

    /**
     * Apaga o cookie existente
     *
     * @param string $cookieName
     * @return bool
     */
    public static function cookieDestroy(string $cookieName): bool
    {
        if (!isset($_COOKIE[$cookieName])) {
            return false;
        }
        setcookie($cookieName, "", time() - 3600);
        return true;
    }
}
