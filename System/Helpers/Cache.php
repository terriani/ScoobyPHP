<?php

namespace Scooby\Helpers;

class Cache
{
    private static $cacheNamespace;
    private static $cachePath;

    public function __construct(string $cacheNamespace = null)
    {
        $namespace = $_SESSION['cacheNamespace'];
        if (!empty($cacheNamespace)) {
            $namespace = $cacheNamespace;
        }

        if (!file_exists(dirname(__DIR__ . -1) . '/SysConfig/ScoobyCache/')) {
            mkdir(dirname(__DIR__ . -1) . '/SysConfig/ScoobyCache/');
        }
        if (!file_exists(dirname(__DIR__ . -1) . '/SysConfig/ScoobyCache/' . $namespace . '/')) {
            mkdir(dirname(__DIR__ . -1) . '/SysConfig/ScoobyCache/' . $namespace . '/');
        }
        if (!file_exists(dirname(__DIR__ . -1) . '/SysConfig/ScoobyCache/' . $namespace . '/cache.txt')) {
            file_put_contents(dirname(__DIR__ . -1) . '/SysConfig/ScoobyCache/' . $namespace . '/cache.txt', null);
        }
        self::$cacheNamespace = $namespace;

        self::$cachePath = dirname(__DIR__ . -1) . '/SysConfig/ScoobyCache/' . $namespace . '/cache.txt';
    }

    /**
     * Seta um valor em uma determianada variavel de sessão
     *
     * @param string $name
     * @param mixed $value
     * @return mixed
     */
    public static function set(string $cacheName, $value)
    {
        $cache = json_decode(file_get_contents(self::$cachePath), true);
        if (!empty($cache)) {
            for ($i = 0; $i < count($cache); $i++) {
                foreach ($cache[$i] as $k => $v) {
                    if ($k === $cacheName) {
                        unset($cache[$i][$k]);
                    }
                    if (empty($cache[$i])) {
                        $cache[$i] = [];
                    }
                }
            }
        }
        $cache[] = [$cacheName => $value];
        file_put_contents(self::$cachePath, json_encode($cache, JSON_PRETTY_PRINT));
    }

    public static function getAll()
    {

        $cacheData = json_decode(file_get_contents(self::$cachePath), true);
        $data = [];
        if (!empty($cacheData)) {
            foreach ($cacheData as $value) {
                if (!empty($value)) {
                    $data[] = $value;
                }
            }
        }
        return $data;
    }

    /**
     * Recupera o valor de uma variavel de sessão dado o nome dela
     *
     * @param string $cacheName
     * @return mixed
     */
    public static function get(string $cacheName)
    {
        $sessionData = json_decode(file_get_contents(self::$cachePath), true);
        if (!empty($sessionData)) {
            foreach ($sessionData as $value) {
                foreach ($value as $k => $v) {
                    if ($k === $cacheName) {
                        return $v;
                    }
                }
            }
        }
    }

    /**
     * Recupera e apaga o valor de uma variavel de sessão
     *
     * @param string $cacheName
     * @return mixed
     */
    public static function getAndErase(string $cacheName)
    {
        $response = self::get($cacheName);
        self::destroy($cacheName);
        return $response;
    }

    /**
     * Destroi uma variavel de sessão caso o index dela seja informado ou destroi
     * toda as variaveis de sessão caso nenhum index seja passado como parametro do metodo
     *
     * @param string $cacheName
     * @return void
     */
    public static function destroy(string $cacheName = ''): void
    {
        $session = json_decode(file_get_contents(self::$cachePath), true);
        if (!empty($cacheName)) {
            if (!empty($session)) {
                for ($i = 0; $i < count($session); $i++) {
                    foreach ($session[$i] as $k => $v) {
                        if ($k === $cacheName) {
                            unset($session[$i][$k]);
                        }
                    }
                }
            }
        } else {
            $session = [];
        }
        file_put_contents(self::$cachePath, json_encode($session, JSON_PRETTY_PRINT));
    }

    public static function getCacheNameSpace()
    {
        return self::$cacheNamespace;
    }

    public static function cacheDelete(string $namespace)
    {
        exec('rm -rf ' . dirname(__DIR__ . -1) . '/SysConfig/ScoobyCache/' . $namespace . '/');
    }
}
