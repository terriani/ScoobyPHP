<?php

namespace Scooby\Components;

use Scooby\Http\Request;
use Scooby\Helpers\FlashMessage;

class ExtendsRequestFormValidateComponent extends Request
{
    /**
     * Extende a classe Request no metodo validate, podendo assim ser criadas validações especificas
     *
     * @param string $input
     * @param string $inputAlias
     * @param string $redirect
     * @param array $rules
     * @param integer $min
     * @param integer $max
     * @return bool
     */
    /** @scrutinizer ignore-unused */
    public static function formValidate(string $input, string $inputAlias, array $rules, int $min = null, int $max = null)
    {
        if (in_array('validation_name', $rules)) {

            $msg = null;

            /**
             * Definindo a menssagem de falha da validação na extenção da classe Request::validate
             *
             * $msg = "validation message";
             *
             * ou criar uma constante nos arquivos de idioma em Config/lang/
             *
             * define('NAMEVALIDATION_VALIDATION', 'MSG VALIDATION')
             */


            /**
             * Definindo a menssagem de falha de validação no arquivo de tradução
             * metodo recomendado para quando a menssagem tem valores dinamicos
             * criar uma variavel global com a constante $_GLOBALS['NAMEVALIDATION_VALIDATION'] => 'MSG VALIDATION'
             * de preferencia em todos os arquivos de idiomas em Config/lang/
             *
             * $msg = strtr($GLOBALS['NAMEVALIDATION_VALIDATION'], [
             * ':atribute' => $inputAlias,
             *  ':min' => $min,
             *  ':max' => $max
             *   ]);
             */

            if ('validation condition') {
                FlashMessage::flashMessage('errMessage', 'Opss...', $msg, 'error');
            }
        }
        /** @scrutinizer ignore-call */
        /** @scrutinizer ignore-type */
        parent::formValidate($input, $inputAlias, $rules, $min, $max);
    }
}
