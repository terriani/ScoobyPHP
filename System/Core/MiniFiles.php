<?php

use MatthiasMullie\Minify;

class MiniFiles
{
    /**
     * Minifica os arquivos css e cria um arquivo único com todo o código css
     *
     * @param string $path
     * @param string $savePath
     * @return boolean
     */
    public static function miniCss(string $path = 'App/Public/assets/css', string $savePath = 'System/MinifyFiles/min-css'): bool
    {
        $fileName = 'scooby-'.md5(ASSETS_VERSION).'.min.css';
        self::assetsRefresh('System/MinifyFiles/min-css/', $fileName);
        $files = scandir($path);
        array_shift($files);
        array_shift($files);
        if (file_exists($savePath.'/'.$fileName)) {
            return false;
        }
        $m = new Minify\CSS();
        foreach ($files as $file) {
            $m->add($path.'/'.$file);
        }
        $m->minify($savePath.'/'.$fileName);
        return true;
    }

    /**
     * Minifica os arquivos js e cria um arquivo único com todo o código js
     *
     * @param string $path
     * @param string $savePath
     * @return boolean
     */
    public static function miniJs(string $path = 'App/Public/assets/js', string $savePath = 'System/MinifyFiles/min-js'): bool
    {
        $fileName = 'scooby-'.md5(ASSETS_VERSION).'.min.js';
        self::assetsRefresh('System/MinifyFiles/min-js/', $fileName);
        $files = scandir($path);
        array_shift($files);
        array_shift($files);
        if (file_exists($savePath.'/'.$fileName)) {
            return false;
        }
        $m = new Minify\JS();
        foreach ($files as $file) {
            $m->add($path.'/'.$file);
        }
        $m->minify($savePath.'/'.$fileName);
        return true;
    }

    /**
     * Caso esteja em ambiente de desenvolvimento e o arquivo minificado
     * exista ele apaga o arquivo minificado para que ele seja recriado
     *
     * @param string $path
     * @param string $name
     * @return void
     */
    private static function assetsRefresh(string $path, string $name): void
    {
        if (getenv('ENV') === 'development' and file_exists($path.$name) ) {
            unlink($path.$name);
        }
    }
}
