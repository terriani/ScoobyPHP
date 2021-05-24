<?php

namespace Scooby\Helpers;

use Zttp\Zttp;

class HttpClient
{
    /**
     * Efetua uma requisição do tipo GET para a URL informada via parametros e retorna um objeto com os dados de retorno
     * Além da URL pode-se passar também três arrays,
     * O primeiro é um array associativo para envio de parametros para a url, ficando por exemplo -> ['foo' => 'bar'], o envio de parametros é ilimitado
     * O segundo é um array associativo para envio de headers para a url, ficando por exemplo -> ['token' => 'abc123'], o envio de headers é ilimitado
     * O Terceiro é um array associativo para envio de options para a url, ficando por exemplo -> ['accept' => 'text/xml'], o envio de options é ilimitado
     *
     * @param string $url
     * @param array $param
     * @param array $headers
     * @param array $options
     * @return object
     */
    public static function get(string $url, array $param = [], array $headers = [], array $options = []): object
    {
        $options['verify'] = filter_var(getenv('SSL_VERIFY'), FILTER_VALIDATE_BOOLEAN);
        $response = Zttp::withOptions($options)->withHeaders($headers)->asMultipart()->asFormParams()->get($url, $param);
        return (object) [
            'headers' => $response->headers(),
            'body' => [
                'json' => $response->json(),
                'raw' => $response->body()
            ],
            'ok' => $response->isSuccess(),
            'status' => $response->status(),
            'serverError' => $response->isServerError(),
            'clientError' => $response->isClientError(),
        ];
    }

    /**
     * Efetua uma requisição do tipo POST para a URL informada via parametros e retorna um objeto com os dados de retorno
     * Além da URL pode-se passar também três arrays,
     * O primeiro é um array associativo para envio de parametros para a url, ficando por exemplo -> ['foo' => 'bar'], o envio de parametros é ilimitado
     * O segundo é um array associativo para envio de headers para a url, ficando por exemplo -> ['token' => 'abc123'], o envio de headers é ilimitado
     * O Terceiro é um array associativo para envio de options para a url, ficando por exemplo -> ['accept' => 'text/xml'], o envio de options é ilimitado
     *
     * @param string $url
     * @param array $param
     * @param array $headers
     * @param array $options
     * @return object
     */
    public static function post(string $url, array $param = [], array $headers = [], array $options = []): object
    {
        $options['verify'] = file_exists(getenv('SSL_VERIFY')) ? getenv('SSL_VERIFY') : false;
        $response = Zttp::withOptions($options)->withHeaders($headers)->asMultipart()->asFormParams()->post($url, $param);
        return (object) [
            'headers' => $response->headers(),
            'body' => [
                'json' => $response->json(),
                'raw' => $response->body()
            ],
            'ok' => $response->isSuccess(),
            'status' => $response->status(),
            'serverError' => $response->isServerError(),
            'clientError' => $response->isClientError(),
        ];
    }

    /**
     * Efetua uma requisição do tipo PUT para a URL informada via parametros e retorna um objeto com os dados de retorno
     * Além da URL pode-se passar também três arrays,
     * O primeiro é um array associativo para envio de parametros para a url, ficando por exemplo -> ['foo' => 'bar'], o envio de parametros é ilimitado
     * O segundo é um array associativo para envio de headers para a url, ficando por exemplo -> ['token' => 'abc123'], o envio de headers é ilimitado
     * O Terceiro é um array associativo para envio de options para a url, ficando por exemplo -> ['accept' => 'text/xml'], o envio de options é ilimitado
     *
     * @param string $url
     * @param array $param
     * @param array $headers
     * @param array $options
     * @return object
     */
    public static function put(string $url, array $param = [], array $headers = [], array $options = []): object
    {
        $options['verify'] = file_exists(getenv('SSL_VERIFY')) ? getenv('SSL_VERIFY') : false;
        $response = Zttp::withOptions($options)->withHeaders($headers)->asMultipart()->asFormParams()->put($url, $param);
        return (object) [
            'headers' => $response->headers(),
            'body' => [
                'json' => $response->json(),
                'raw' => $response->body()
            ],
            'ok' => $response->isSuccess(),
            'status' => $response->status(),
            'serverError' => $response->isServerError(),
            'clientError' => $response->isClientError(),
        ];
    }

    /**
     * Efetua uma requisição do tipo DELETE para a URL informada via parametros e retorna um objeto com os dados de retorno
     * Além da URL pode-se passar também três arrays,
     * O primeiro é um array associativo para envio de parametros para a url, ficando por exemplo -> ['foo' => 'bar'], o envio de parametros é ilimitado
     * O segundo é um array associativo para envio de headers para a url, ficando por exemplo -> ['token' => 'abc123'], o envio de headers é ilimitado
     * O Terceiro é um array associativo para envio de options para a url, ficando por exemplo -> ['accept' => 'text/xml'], o envio de options é ilimitado
     *
     * @param string $url
     * @param array $param
     * @param array $headers
     * @param array $options
     * @return object
     */
    public static function delete(string $url, array $param = [], array $headers = [], array $options = []): object
    {
        $options['verify'] = file_exists(getenv('SSL_VERIFY')) ? getenv('SSL_VERIFY') : false;
        $response = Zttp::withOptions($options)->withHeaders($headers)->asMultipart()->asFormParams()->delete($url, $param);
        return (object) [
            'headers' => $response->headers(),
            'body' => [
                'json' => $response->json(),
                'raw' => $response->body()
            ],
            'ok' => $response->isSuccess(),
            'status' => $response->status(),
            'serverError' => $response->isServerError(),
            'clientError' => $response->isClientError(),
        ];
    }
}
