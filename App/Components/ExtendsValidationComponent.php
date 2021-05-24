<?php

namespace Scooby\Components;

use Scooby\Helpers\Validation;

class ExtendsValidationComponent extends Validation
{
    /**
     * Defina um metodo de validadção especifico
     *
     * Ex:
     *
     * public static function isTrue($value)
     * {
     *   if (is_bool($value) !== true) {
     *       return false;
     *   }
     *  return true;
     * }
     */
}
