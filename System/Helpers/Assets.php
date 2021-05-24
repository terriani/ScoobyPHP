<?php

namespace Scooby\Helpers;

class Assets
{
    /**
     * Carrega os arquivos de css da aplicação
     *
     * @param array $css
     * @return void
     */
    public static function headerLoad(): void
    {
        require 'App/Config/assetsInclude.php';
        foreach ($html['header'] as $header) {
            echo $header;
        }
    }

    /**
     * Carrega os arquivos de js da aplicação
     *
     * @param array $css
     * @return void
     */
    public static function bodyTopLoad(): void
    {
        require 'App/Config/assetsInclude.php';
        foreach ($html['bodyTop'] as $bodyTop) {
            echo $bodyTop;
        }
    }

    /**
     * Carrega os arquivos de js da aplicação
     *
     * @param array $css
     * @return void
     */
    public static function bodyBottomLoad(): void
    {
        require 'App/Config/assetsInclude.php';
        foreach ($html['bodyBottom'] as $bodyBottom) {
            echo $bodyBottom;
        }
    }
}