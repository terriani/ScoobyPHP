<?php

namespace Scooby\Helpers;

class Auth
{
    /**
     * Metodo construtor que valida o login ou redireciona para o logout
     *
     * @return boolean
     */
    public static function authValidation(): bool
    {
        if (
            isset($_SESSION['id'])
            and !empty($_SESSION['id'])
            and isset($_SESSION['statusLog'])
            and !empty($_SESSION['statusLog'])
            and $_SESSION['statusLog'] === true
        ) {
            if (!empty($_SESSION['ownerSession'])) {
                Session::sessionTokenValidade();
            }
            return true;
        } else {
            $_SESSION['id'] = null;
            $_SESSION['statusLog'] = false;
            return false;
        }
    }

    /**
     * auxilia na validação de login de usuario caso o 
     * mesmo não esteja logado ele sera redirecionado para a tela de erro
     *
     * @return bool
     */
    public static function authValidOrFail($redirect = 'ooops/404'): bool
    {
        if (!self::authValidation()) {
            Redirect::redirectTo($redirect);
            return false;
        }
        return true;
    }
}
