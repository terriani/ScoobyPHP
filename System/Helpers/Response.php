<?php

namespace Scooby\Helpers;

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
}