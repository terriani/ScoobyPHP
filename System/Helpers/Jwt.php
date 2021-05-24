<?php

namespace Scooby\Helpers;

use Scooby\Models\Authorization;
use Scooby\Models\LoggedTokens;
use stdClass;

class Jwt
{
    /**
     * Cria um novo token JWT
     *
     * @param array $data
     * @return string
     */
    public static function jwtCreate(array $data): object
    {
        $header = json_encode([
            'typ' => 'JWT',
            'alg' => 'HS256'
        ]);
        $payload = json_encode($data);
        $headerToken = self::base64_encode_url($header);
        $payloadToken = self::base64_encode_url($payload);
        $key = self::jwtSaltGenerate();
        $signature = hash_hmac("sha256", $headerToken . '.' . $payloadToken, $key, true);
        $signatureToken = self::base64_encode_url($signature);
        $jwt = $headerToken . '.' . $payloadToken . '.' . $signatureToken;
        $response = new stdClass;
        $response->key  = $key;
        $response->jwt = $jwt;
        return $response;
    }

    /**
     * Valida um token JWT informado
     *
     * @param string $token
     * @return boolean
     */
    public static function jwtValidate(string $token): bool
    {
        if (!self::jwtGetTokenDb($token) or self::jwtExistsTokenInExpiredDb($token)) {
            Response::json(['data' => 'Token Inválido']);
            return false;
        }
        $jwt = explode('.', $token);
        $logged = new LoggedTokens;
        $l = $logged->where('token', $token)->get()->first();
        $key = $l->app_key;
        if (count($jwt) == 3) {
            $signature = hash_hmac("sha256", $jwt[0] . '.' . $jwt[1], $key, true);
            $signatureToken = self::base64_encode_url($signature);

            if ($signatureToken == $jwt[2] and isset($jwt[2])) {
                return true;
            } else {
                Response::json(['data' => 'Token Inválido']);
                return false;
            }
        } else {
            Response::json(['data' => 'Token não enviado']);
            return false;
        }
    }

    /**
     * Decodifica o payload do token informado
     *
     * @param string $token
     * @return array
     */
    public static function jwtPayloadDecode(string $token): object
    {
        $tokenSplit = explode('.', $token);
        return (object) json_decode(self::base64_decode_url($tokenSplit[1]));
    }

    /**
     * Recupera o token JWT passado na requisição pelo header da aplicação
     *
     * @param string $token
     * @return void|string
     */
    public static function jwtGetToken(string $token = 'Authorization')
    {
        if (!isset(apache_request_headers()[$token])) {
            return false;
        }
        $t = apache_request_headers()[$token];
        $jwt = str_replace('Bearer ', '', $t);
        return $jwt;
    }

    /**
     * Expira o JWT o colocando na black list
     *
     * @param string $token
     * @param string $path
     * @return void
     */
    public static function jwtExpire(string $token/* , string $path = 'System/SysConfig/BlackList.txt' */)
    {
        $auth = new Authorization;
        if (!self::jwtExistsTokenInExpiredDb($token)) {
            $auth->invalid_token = $token;
            $auth->user_id = self::jwtPayloadDecode($token)->id;
            $auth->save();
        }
    }

    /**
     * Valida o JWT novamente o retirando da black list
     *
     * @param string $token
     * @param string $path
     * @return void
     */
    public static function jwtRefresh(string $token/* , string $path = 'System/SysConfig/BlackList.txt' */)
    {
        $data = (array) self::jwtPayloadDecode($token);
        self::jwtSaltGenerate();
        return self::jwtCreate($data);
    }

    /**
     * Codifica uma string em base64
     *
     * @param string $string
     * @return string
     */
    private static function base64_encode_url(string $string): string
    {
        return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($string));
    }

    /**
     * Decodifica uma string em base64
     *
     * @param string $string
     * @return string
     */
    private static function base64_decode_url(string $string): string
    {
        return base64_decode(str_replace(['-', '_'], ['+', '/'], $string));
    }

    /**
     * Cria um token jwt
     *
     * @return void
     */
    public static function jwtKeyGenerate($secret = 'secret')
    {
        $key = hash('sha256', md5(rand(11111111, 99999999) . uniqid(rand(), true) . time()));
        $generate = file_get_contents('.env');
        $generate = strtr($generate, [
            $secret =>  "$key"
        ]);
        $f = fopen(".env", 'w+');
        fwrite($f, $generate);
        fclose($f);
        Debug::log('SALT gerado em .env');
    }

    /**
     * Cria um Salt para o token jwt
     *
     * @return void
     */
    public static function jwtSaltGenerate(): string
    {
        return hash('sha256', md5(rand(11111111, 99999999) . uniqid(rand(), true) . time()));
    }

    private static function jwtGetTokenDb($token)
    {
        return LoggedTokens::where('token', '=', $token)->exists();
    }

    public static function jwtExistsTokenInExpiredDb(string $token)
    {
        $id = self::jwtPayloadDecode($token)->id;
        $auth = new Authorization;
        $tokenArr = [];
        foreach ($auth->where('user_id', $id)->get() as $value) {
            $tokenArr[] = $value->invalid_token;
        }
        return in_array($token, $tokenArr);
    }
}
