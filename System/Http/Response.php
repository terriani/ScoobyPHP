<?php

namespace Scooby\Http;

class Response
{
    /**
     * Retorna um array json
     *
     * @param int $code
     * @param string|array $data
     * @return void
     */
    public static function json($data, int $code = 200): void
    {
        header('Content-type: application/json');
        http_response_code($code);
        echo json_encode($data);
        exit;
    }

    /**
     * Retorna os dados para a view
     *
     * @param array $data
     * @param string $viewName
     * @param string $viewPath
     * @param integer $code
     * @return void
     */
    public static function html(array $data, string $viewName, string $viewPath, $twig, int $code = 200): void
    {
        header('Content-type: text/html');
        http_response_code($code);
        require_once 'System/Html/Templates/Header.php';
        $template = $twig->load(ucfirst($viewPath) . '/' . ucfirst($viewName) . '.twig');
        extract($data);
        echo $template->render($data);
        require_once 'System/Html/Templates/Footer.php';
    }
}
