<?php

namespace Scooby\Helpers;

class FlashMessage
{
    /**
     * Exibe uma msg no tipo Toast para o usuário
     *
     * @param string $title
     * @param string $body
     * @param string $type
     * @return void
     */
    public static function toast(string $title, string $body, string $type = "show"): void
    {
        require_once "System/Html/Templates/Header.php";
        $msg = <<<HTML
        <script>
            Toast.fire({
                title: '$title',
                text: '$body',
                type: '$type'
            })
        </script>
HTML;
        echo $msg;
    }

    /**
     * Exibe uma menssagem no tipo Toast para o usuario e faz o redirecionamento do mesmo
     *
     * @param string $title
     * @param string $body
     * @param string $type
     * @param string $url
     * @return void
     */
    public static function toastWithHref(string $title, string $body, string $type = "show", string $url): void
    {
        require_once "System/Html/Templates/Header.php";
        $url = BASE_URL . $url;
        $msg = <<<HTML
        <script>
            Toast.fire({
                title: '$title',
                text: '$body',
                type: '$type',
            }).then(function (result) {
                    if (result.value) {
                    window.location = "$url";
                }
            });
        </script>
HTML;
        echo $msg;
    }

    /**
     * Exibe uma menssagem no tipo Toast para o usuario e faz o redirecionamento do mesmo
     *
     * @param string $title
     * @param string $body
     * @param string $type
     * @param integer $value
     * @return void
     */
    public static function toastWithGoBack(string $title, string $body, string $type = "show", int $value = -1): void
    {
        require_once "System/Html/Templates/Header.php";
        $msg = <<<HTML
        <script>
            Toast.fire({
                title: '$title',
                text: '$body',
                type: '$type',
            }).then(function(result){
                window.history.go($value);
            })
        </script>
HTML;
        echo $msg;
    }

    /**
     * Exibe uma msg no tipo Toast para o usuário
     *
     * @param string $title
     * @param string $body
     * @param string $type
     * @return void
     */
    public static function modal(string $title, string $body, string $type = "show"): void
    {
        require_once "System/Html/Templates/Header.php";
        $msg = <<<HTML
        <script>
            Swal.fire({
                title: '$title',
                text: '$body',
                type: '$type'
            })
        </script>
HTML;
        echo $msg;
    }

    /**
     * Exibe uma menssagem no tipo Toast para o usuario e faz o redirecionamento do mesmo
     *
     * @param string $title
     * @param string $body
     * @param string $type
     * @param string $url
     * @return void
     */
    public static function modalWithHref(string $title, string $body, string $type = "show", string $url): void
    {
        require_once "System/Html/Templates/Header.php";
        $url = BASE_URL . $url;
        $msg = <<<HTML
        <script>
            Swal.fire({
                title: '$title',
                text: '$body',
                type: '$type',
            }).then(function (result) {
                        if (result.value) {
                        window.location = "$url";
  }
});
        </script>
HTML;
        echo $msg;
    }

    /**
     * Exibe uma menssagem no tipo Toast para o usuario e faz o redirecionamento do mesmo
     *
     * @param string $title
     * @param string $body
     * @param string $type
     * @param integer $value
     * @return void
     */
    public static function modalWithGoBack(string $title, string $body, string $type = "show", int $value = -1): void
    {
        require_once "System/Html/Templates/Header.php";
        $msg = <<<HTML
        <script>
            Swal.fire({
                title: '$title',
                text: '$body',
                type: '$type',
            }).then(function(result){
                window.history.go($value);
            })
        </script>
HTML;
        echo $msg;
    }

    /**
     * passa uma msg via session
     *
     * @param string $url
     * @param string $msg
     * @param string $type
     * @return void
     */
    public static function flashMessage($key, $title, $msg, $type = 'info', $redirect = null): void
    {
        $_SESSION['flash'][$key] = [
            'title' => $title,
            'msg' => $msg,
            'type' => $type
        ];
        if ($redirect === null) {
            Redirect::redirectBack();
        } else {
            Redirect::redirectTo($redirect);
        }
    }

    /**
     * Exibe a menssagem passada pela url
     *
     * @param string $msg
     * @return void
     */
    public static function getFlashMessage($key): void
    {
        if (!empty($_SESSION['flash'][$key])) {
            $flashMessage = $_SESSION['flash'][$key];
            unset($_SESSION['flash'][$key]);
            self::toast($flashMessage['title'], $flashMessage['msg'], $flashMessage['type']);
        }
    }
}
