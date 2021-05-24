<?php

namespace Scooby\Helpers;

class Seo
{
    /*
     * Carrega as keywords do projeto na meta tag 
     *
     * @return void
     */
    public static function keywordsLoad(): void
    {
        $keywords = KEYWORDS;
        $keywords = implode(',', $keywords);
        echo "<meta name='keywords' content='{$keywords}'>";
    }
}