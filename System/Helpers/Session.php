<?php

namespace Scooby\Helpers;

class Session
{
    /**
     * Cria um token de segurança para a sessão
     *
     * @return void
     */
    public static function sessionTokenGenerate(): void
    {
        if (empty($_SESSION['ownerSession'])) {
            $_SESSION['ownerSession'] = md5($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT'].SECRET_KEY);
        }
    }

    /**
     * Testa a validade do token de sessão
     *
     * @return bool
     */
    public static function sessionTokenValidade()
    {
        $token = md5($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT'] . SECRET_KEY);
        if (!empty($_SESSION['ownerSession']) and $_SESSION['ownerSession'] == $token) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Seta um valor em uma determianada variavel de sessão
     *
     * @param string $name
     * @param string $value
     * @return string
     */
    public static function setSession(string $sessionName, string $value): string
    {
        return $_SESSION[$sessionName] = $value;
    }

    /**
     * Recupera o valor de uma variavel de sessão dado o nome dela
     *
     * @param string $sessionName
     * @return string
     */
    public static function getSession(string $sessionName): string
    {
        return $_SESSION[$sessionName];
    }

    /**
     * Recupera e apaga o valor de uma variavel de sessão
     *
     * @param string $sessionName
     * @return string
     */
    public static function getAndEraseSession(string $sessionName): string
    {
        echo $_SESSION[$sessionName];
        return $_SESSION[$sessionName] = '';
    }

    /**
     * Destroi uma variavel de sessão caso o index dela seja informado ou destroi
     * toda as variaveis de sessão caso nenhum index seja passado como parametro do metodo
     *
     * @param string $sessionName
     * @return void
     */
    public static function sessionDestroy(string $sessionName = ''): void
    {
        if (!empty($sessionName)) {
            unset($_SESSION[$sessionName]);
        } else {
            session_destroy();
        }
    }
}
