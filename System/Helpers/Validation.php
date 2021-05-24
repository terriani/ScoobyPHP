<?php

namespace Scooby\Helpers;

use Illuminate\Database\Capsule\Manager as db;

/**
 * Classe de validação e sanitização de dados.
 * Email;
 * Sanitiza email;
 * Em array;
 * Existe email no banco de dados;
 */
class Validation
{

    /**
     * Retorna true se o valor for um Email valido
     *
     * @param string $value
     * @return boolean
     */
    public static function isEmail($value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }

    /**
     * Sanitiza o email
     *
     * @param string $value
     * @return string|bool
     */
    public static function sanitizeEmail($value)
    {
        if (self::isEmail($value) === false) {
            return false;
        }
        return filter_var($value, FILTER_SANITIZE_EMAIL);
    }

    /**
     * Retorna true se o valor existir no array informado
     *
     * @param mixed $value
     * @param array $arr
     * @return bool
     */
    public static function hasInArray($value, array $arr)
    {
        if (!in_array($value, $arr)) {
            return false;
        }
        return true;
    }

    /**
     * Retorna true se o email não existir no banco de dados informado
     *
     * @param string $value
     * @param string $tableName
     * @param string $emailField
     * @return bool
     */
    public static function emailMatch($value, string $tableName, string $emailField)
    {
        if (self::isEmail($value) === false) {
            return false;
        }
        $value = self::sanitizeEmail($value);
        $helper = new Helper;
        $helper->illuminateDb();
        if (DB::table($tableName)->where($emailField, $value)->count() > 0 === true) {
            return false;
        }
        return true;
    }
}
