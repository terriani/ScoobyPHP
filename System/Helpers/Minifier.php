<?php

namespace Scooby\Helpers;

use Exception;
use \MatthiasMullie\Minify;

class Minifier
{
    public static function minify($path, $pathSave, $minifyName, $type): bool
    {
        if ($type != 'css' and $type != 'js') {
            throw new Exception('[ '.$type.' ] Invalid format');
        }
        if ($type == "css") {
            $sourcePath = $path."/".$minifyName.".css";
            $minifier = new Minify\CSS();
            $minifier->add($sourcePath);
            $minifiedPath = $pathSave."/".$minifyName.".min.css";
            $minifier->minify($minifiedPath);
            return true;
        }
        if ($type == "js") {
            $sourcePath = $path."/".$minifyName.".js";
            $minifier = new Minify\JS();
            $minifier->add($sourcePath);
            $minifiedPath = $pathSave."/".$minifyName.".min.js";
            $minifier->minify($minifiedPath);
            return true;
        }
        return false;
    }
}
