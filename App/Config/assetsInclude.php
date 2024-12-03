<?php

use Scooby\I18n\I18n;

$html = [
    'header' => [
        "<link rel='stylesheet' href='" . ROUTE . "/node_modules/animate.css/animate.min.css'>",
        "<link rel='stylesheet' href='". ROUTE ."/node_modules/materialize-css/dist/css/materialize.min.css'>",
        "<link href='https://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>",

        /**
         * Este arquivo carrega todos os arquivos JS minificados criados na pasta App/Public/assets/js/
         */
        "<link rel='stylesheet' href='" . ROUTE . "/System/MinifyFiles/min-css/scooby" . ASSETS_HASH . ".min.css'>",
    ],
    'bodyTop' => [
        "<script src='" . ROUTE . "/node_modules/jquery/dist/jquery.min.js'></script>",
        "<script src='" . ROUTE . "/node_modules/sweetalert2/dist/sweetalert2.all.min.js'></script>",
        "<script src='". ROUTE . "/node_modules/materialize-css/dist/js/materialize.min.js'></script>",

        /**
         * Este arquivo carrega todos os arquivos JS minificados criados na pasta App/Public/assets/js/
         */

        "<script src='" . ROUTE . "/System/MinifyFiles/min-js/scooby" . ASSETS_HASH . ".min.js'></script>"
    ],
    'bodyBottom' => [


        /**
         * Esta função gera um alert do tipo toast sempre a internet do usuario cair ou ser restabelecida,
         * você encontra esta função  em App/Public/assets/js/scooby.js
         */
        '<script>
            isOnline(
                "' . I18n::translate("error", "CONNECTION_FAILURE_TITLE") . '",
                "' . I18n::translate("error", "CONNECTION_FAILURE") . '",
                "' . I18n::translate("error", "CONNECTION_TITLE") . '",
                "' . I18n::translate("error", "RESTORED_CONNECTION") . '"
            )
        </script>'
    ]
];
