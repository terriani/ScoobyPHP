<?php

use Scooby\Helpers\Cache;
use Scooby\I18n\I18n;

$filter = new \Twig\TwigFilter('encode', function ($string) {
    return base64_encode($string);
});
$userName = null;
if (!empty((new Cache())::get('user'))) {
    $userName = ucfirst(explode(' ', (new Cache())::get('user')['name'])[0]);
}
// Crie variaveis globais para serem usadas nos templates twig
return [
    $twig->addGlobal('username', $userName),
    $twig->addGlobal('btn_sign_in', I18n::translate('msg', 'BTN_SIGN_IN')),
    $twig->addGlobal('btn_sign_out', I18n::translate('msg', 'BTN_SIGN_OUT')),
    $twig->addGlobal('btn_sign_up', I18n::translate('msg', 'BTN_SIGN_UP')),
    $twig->addGlobal('btn_update', I18n::translate('msg', 'BTN_UPDATE')),
    $twig->addGlobal('btn_delete', I18n::translate('msg', 'BTN_DELETE')),
    $twig->addGlobal('btn_back', I18n::translate('msg', 'BTN_BACK')),
    $twig->addGlobal('btn_send', I18n::translate('msg', 'BTN_SEND')),
    $twig->addGlobal('btn_password_reset', I18n::translate('msg', 'BTN_PASSWORD_RESET')),
    $twig->addGlobal('route', ROUTE),
    $twig->addFilter($filter)
];
