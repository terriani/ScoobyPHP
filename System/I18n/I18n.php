<?php

namespace Scooby\I18n;

class I18n
{
    public static function translate(string $domain, string $msgKey, array $attributes = []): string
    {
        if (!file_exists('App/Config/Lang/' . SITE_LANG . '/' . $domain . '.json')) {
            return $msgKey;
        }

        $msg = json_decode(file_get_contents('App/Config/Lang/' . SITE_LANG . '/' . $domain . '.json'))->{$msgKey} ?? $msgKey;

        if (empty($attributes)) {
            return $msg;
        }

        foreach ($attributes as $key => $value) {
            $msg = str_replace('{' . $key + 1 . '}', $value ?? '', $msg);
        }

        return $msg;
    }
}
