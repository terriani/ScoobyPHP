<?php

namespace Scooby\Http;

use Scooby\Guard\Csrf;
use Scooby\Helpers\FlashMessage;
use Scooby\Helpers\Redirect;
use Scooby\Helpers\Validation;
use Scooby\Log\Log;

class Request
{

    private static $requestData;
    private static $paramsData;
    private static $route;

    /**
     * Retorna o tipo do método da requisição http
     *
     * @return string
     */
    public static function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'] ?? '';
    }

    /**
     * Retorna todos os headers da requisição
     *
     * @return array
     */
    public static function getHeaders(): array
    {
        return getallheaders() ?? [];
    }

    public static function getUri(): string
    {
        return $_SERVER['REQUEST_URI'] ?? '';
    }

    /**
     * ATENÇÃO USANDO ESTE MÉTODO OS DADOS DA REQUISIÇÃO NÃO SERÃO FILTRADOS PARA A RETIRADA DE CÓDIGOS MALICIOSOS
     * por padrão retorna os dados da requisição no formato de objeto,
     * caso setado na chamada do metodo como false ele retornará os dados da request
     * no formato de array
     *
     * @param boolean $obj
     * @return object|array
     */
    public static function getRequestNaturalData(bool $obj = true)
    {
        if (getenv('CSRF_PROTECTION') == "true") {
            if ((!Csrf::csrfTokenValidate() and IS_API == 'false')) {
                Log::log('Request recusado, falha na autenticação de csrf');
                Redirect::redirectTo('ooops/404');
                return false;
            }
        }
        switch (self::getMethod()) {
            case 'GET':
                $data = $_GET;
                if (!$obj) {
                    return $data;
                }
                return (object) $data;
            case 'PUT':
            case 'DELETE':
                parse_str(file_get_contents('php://input'), $data);
                if (!$obj) {
                    return $data;
                }
                return (object) $data;
            case 'POST':
                $data = json_decode(file_get_contents('php://input'));
                if (is_null($data)) {
                    $data = $_POST;
                }
                if (!$obj) {
                    return $data;
                }
                return (object) $data;
        }
        return [];
    }

    /**
     * por padrão retorna os dados da requisição no formato de objeto,
     * caso setado na chamada do metodo como false ele retornará os dados da request
     * no formato de array
     *
     * @param boolean $obj
     * @return object|array
     */
    public static function getRequestData(bool $obj = true)
    {
        if (getenv('CSRF_PROTECTION') == "true") {
            if ((!Csrf::csrfTokenValidate() and IS_API == 'false')) {
                Log::log('Request recusado, falha na autenticação de csrf');
                Redirect::redirectTo('ooops/404');
                return false;
            }
        }
        switch (self::getMethod()) {
            case 'GET':
                $data = $_GET;
                $data = self::filterRequest($data);
                if (!$obj) {
                    return $data;
                }
                return (object) $data;
            case 'PUT':
            case 'DELETE':
                parse_str(file_get_contents('php://input'), $data);
                $data = self::filterRequest($data);
                if (!$obj) {
                    return $data;
                }
                return (object) $data;
            case 'POST':
                $data = json_decode(file_get_contents('php://input'));
                if (is_null($data)) {
                    $data = $_POST;
                }
                $data = self::filterRequest($data);
                if (!$obj) {
                    return $data;
                }
                return (object) $data;
        }
        return [];
    }

    public static function setRequest($data)
    {
        self::$requestData = $data;
    }

    public static function setRoute($data)
    {
        self::$route = $data;
    }

    public static function getRoute()
    {
        return self::$route;
    }

    public static function setParams($data)
    {
        self::$paramsData = $data;
    }

    public static function getRequest($param = null, $obj = true)
    {
        if (getenv('CSRF_PROTECTION') == "true") {
            if ((!Csrf::csrfTokenValidate() and IS_API == 'false')) {
                Log::log('Request recusado, falha na autenticação de csrf');
                Redirect::redirectTo('ooops/404');
                return false;
            }
        }
        if (empty($param)) {
            return ($obj) ? (object) self::filterRequest(self::$requestData) : (array) self::filterRequest(self::$requestData);
        }
        if (is_string($param)) {
            foreach (self::$requestData as $key => $value) {
                if ($key === $param) {
                    return ($obj) ? (object) self::filterRequest($value) : (array) self::filterRequest($value);
                }
            }
        }
        if (is_array($param)) {
            $data = [];
            foreach ($param as $value) {
                foreach (self::$requestData as $key => $val) {
                    if ($value === $key) {
                        $data[$key] = $val;
                    }
                }
            }
            return ($obj) ? (object) self::filterRequest($data) : (array) self::filterRequest($data);
        }
    }

    public static function getRequestExcept($param, $obj = true)
    {
        if (getenv('CSRF_PROTECTION') == "true") {
            if ((!Csrf::csrfTokenValidate() and IS_API == 'false')) {
                Log::log('Request recusado, falha na autenticação de csrf');
                Redirect::redirectTo('ooops/404');
                return false;
            }
        }
        if (is_string($param)) {
            $data = [];
            foreach (self::$requestData as $key => $value) {
                if ($key !== $param) {
                    $data[$key] = $value;
                }
            }
            return ($obj) ? (object) self::filterRequest($data) : (array) self::filterRequest($data);
        }
        if (is_array($param)) {
            $data = [];
            foreach (self::$requestData as $key => $val) {
                if (!in_array($key, $param)) {
                    $data[$key] = $val;
                }
            }
            return ($obj) ? (object) self::filterRequest($data) : (array) self::filterRequest($data);
        }
    }

    public static function getParams($param = null, $obj = true)
    {
        if (getenv('CSRF_PROTECTION') == "true") {
            if ((!Csrf::csrfTokenValidate() and IS_API == 'false')) {
                Log::log('Request recusado, falha na autenticação de csrf');
                Redirect::redirectTo('ooops/404');
                return false;
            }
        }
        if (empty($param)) {
            return self::filterRequest(self::$paramsData);
        }
        if (is_string($param)) {
            foreach (self::$paramsData as $key => $value) {
                if ($key === $param) {
                    return self::filterRequest(self::$paramsData->{$param});
                }
            }
        }
        if (is_array($param)) {
            $data = [];
            foreach (self::$paramsData as $key => $val) {
                Log::debug(['k' => $key, 'p' => $param]);
                if (!in_array($key, $param)) {
                    $data[$key] = $val;
                }
            }
            return ($obj) ? (object) self::filterRequest($data) : (array) self::filterRequest($data);
        }
    }

    public static function getParamsExcept($param, $obj = true)
    {
        if (getenv('CSRF_PROTECTION') == "true") {
            if ((!Csrf::csrfTokenValidate() and IS_API == 'false')) {
                Log::log('Request recusado, falha na autenticação de csrf');
                Redirect::redirectTo('ooops/404');
                return false;
            }
        }
        if (is_string($param)) {
            $data = [];
            foreach (self::$paramsData as $key => $value) {
                if ($key !== $param) {
                    $data[$key] = $value;
                }
            }
            return ($obj) ? (object) self::filterRequest($data) : (array) self::filterRequest($data);
        }
        if (is_array($param)) {
            $data = [];
            foreach (self::$paramsData as $key => $val) {
                if (!in_array($key, $param)) {
                    $data[$key] = $val;
                }
            }
            return ($obj) ? (object) self::filterRequest($data) : (array) self::filterRequest($data);
        }
    }

    /**
     * Filtra o valor retornado pelo metodo getRequestData
     *
     * @param array $data
     * @return array
     */
    private static function filterRequest($data): array
    {
        $arr = [];
        foreach ($data as $key => $value) {
            $arr[$key] = htmlspecialchars(strip_tags(addslashes(trim($value))));
        }
        return $arr;
    }

    /**
     * por padrão retorna os dados selecionados da requisição no formato de objeto,
     * caso setado na chamada do metodo como false ele retornará os dados da request
     * no formato de array
     *
     * @param array $inputs
     * @param boolean $obj
     * @return object|array
     */
    public static function getRequestOnly(array $inputs, bool $obj = true)
    {
        if (getenv('CSRF_PROTECTION') == "true") {
            if ((!Csrf::csrfTokenValidate() and IS_API == 'false')) {
                Log::log('Request recusado, falha na autenticação de csrf');
                Redirect::redirectTo('ooops/404');
                return false;
            }
        }
        $data = [];
        $arr = (array) self::getRequestData();
        foreach ($inputs as $input) {
            $data[$input] = $arr[$input];
        }
        $data = self::filterRequest($data);
        if (!$obj) {
            return (array) $data;
        }
        return (object) $data;
    }

    /**
     * por padrão retorna os dados da requisição exceto os selecionados no formato de objeto,
     * caso setado na chamada do metodo como false ele retornará os dados da request
     * no formato de array
     *
     * @param  array $inputs
     * @param boolean $obj
     * @return object|array
     */
    public static function getRequestDataExcept(array $inputs, bool $obj = true)
    {
        if (getenv('CSRF_PROTECTION') == "true") {
            if ((!Csrf::csrfTokenValidate() and IS_API == 'false')) {
                Log::log('Request recusado, falha na autenticação de csrf');
                Redirect::redirectTo('ooops/404');
                return false;
            }
        }
        $data = [];
        $arr = (array) self::getRequestData();
        foreach ($arr as $key => $value) {
            if (!in_array($key, $inputs)) {
                $data[$key] = $arr[$key];
            }
        }
        $data = self::filterRequest($data);
        if (!$obj) {
            return (array) $data;
        }
        return (object) $data;
    }

    /**
     * Valida e retorna o dados vindo do formulario
     *
     * @param string $inputName
     * @return string|bool
     */
    public static function input(string $inputName)
    {
        if (getenv('CSRF_PROTECTION') == "true") {
            if ((!Csrf::csrfTokenValidate() and IS_API == 'false')) {
                Log::log('Request recusado, falha na autenticação de csrf');
                Redirect::redirectTo('ooops/404');
                return false;
            }
        }

        if (self::has($inputName)) {
            if (isset($_REQUEST["$inputName"]) and !empty($_REQUEST["$inputName"])) {
                return htmlspecialchars(strip_tags(addslashes(trim($_REQUEST["$inputName"]))));
            }
            return false;
        }
        return false;
    }

    /**
     * Valida e retorna o dados vindo do formulario
     *
     * @param string $inputName
     * @return string|bool
     */
    public static function get(string $inputName)
    {
        if (getenv('CSRF_PROTECTION') == "true") {
            if ((!Csrf::csrfTokenValidate() and IS_API == 'false')) {
                Log::log('Request recusado, falha na autenticação de csrf');
                Redirect::redirectTo('ooops/404');
                return false;
            }
        }
        if (self::has($inputName)) {
            if (isset($_GET["$inputName"]) and !empty($_GET["$inputName"])) {
                return htmlspecialchars(strip_tags(addslashes(trim($_GET["$inputName"]))));
            }
            return false;
        }
        return false;
    }

    /**
     * Valida e retorna o dados vindo do formulario
     *
     * @param string $inputName
     * @return string|bool
     */
    public static function post(string $inputName)
    {
        if (getenv('CSRF_PROTECTION') == "true") {
            if ((!Csrf::csrfTokenValidate() and IS_API == 'false')) {
                Log::log('Request recusado, falha na autenticação de csrf');
                Redirect::redirectTo('ooops/404');
                return false;
            }
        }
        if (self::has($inputName)) {
            if (isset($_POST["$inputName"]) and !empty($_POST["$inputName"])) {
                return htmlspecialchars(strip_tags(addslashes(trim($_POST["$inputName"]))));
            }
            return false;
        }
        return false;
    }

    /**
     * Executa o upload de arquivos
     *
     * @param string $name
     * @param array $type
     * @param string $path
     * @return array|bool
     */
    public static function upload(string $name, array $type = [], string $path = 'App/Public/uploaded/')
    {
        if (getenv('CSRF_PROTECTION') == "true") {
            if ((!Csrf::csrfTokenValidate() and IS_API == 'false')) {
                Log::log('Request recusado, falha na autenticação de csrf');
                Redirect::redirectTo('ooops/404');
                return 1;
            }
        }
        $arrPath = [];
        if (!isset($_FILES[$name]) or empty($_FILES[$name])) {
            return 2;
        }
        if (is_array($_FILES[$name]['tmp_name'])) {
            $count = count($_FILES[$name]['tmp_name']);
            if ($count > 0) {
                for ($i = 0; $i < $count; $i++) {
                    $mimeType = $_FILES[$name]['type'][$i];
                    if (!empty($type) and !in_array($_FILES[$name]['type'][$i], $type)) {
                        if (IS_API == 'true') {
                            Response::json(['data' => $GLOBALS['MSG_UPLOAD_FAIL']]);
                        }
                        FlashMessage::modalWithGoBack('Opss', $GLOBALS['MSG_UPLOAD_FAIL'], 'error');
                        exit;
                    }
                    $arrMimeType = explode('/', $mimeType);
                    $ext = end($arrMimeType);
                    $fileName = md5($_FILES[$name]['name'][$i] . time() . rand(0, 99999));
                    move_uploaded_file($_FILES[$name]['tmp_name'][$i], $path . $fileName . "." . $ext);
                    $arrPath[$i] = $path . $fileName . '.' . $ext;
                }
                return [true, $arrPath];
            } else {
                if (IS_API == 'true') {
                    Response::json(['data' => $GLOBALS['MSG_UPLOAD_FAIL']]);
                }
            }
            FlashMessage::modalWithGoBack('Opss', $GLOBALS['MSG_UPLOAD_FAIL'], 'error');
        } else {
            $mimeType = $_FILES[$name]['type'];
            if (!empty($type) and !in_array($_FILES[$name]['type'], $type)) {
                if (IS_API == 'true') {
                    Response::json(['data' => $GLOBALS['MSG_UPLOAD_FAIL']]);
                }
                FlashMessage::modalWithGoBack('Opss', $GLOBALS['MSG_UPLOAD_FAIL'], 'error');
                exit;
            }
            $arrMimeType = explode('/', $mimeType);
            $ext = end($arrMimeType);
            $fileName = md5($_FILES[$name]['name'] . time() . rand(0, 99999));
            move_uploaded_file($_FILES[$name]['tmp_name'], $path . $fileName . "." . $ext);
            $arrPath[] = $path . $fileName . '.' . $ext;
            return [true, $arrPath];
        }
        return [];
    }

    /**
     * Testa se o valor do input é positivo
     *
     * @param string $inputName
     * @return bool
     */
    public static function inputPositive(string $inputName)
    {
        if (self::input($inputName) < 1) {
            return false;
        }
        return true;
    }

    /**
     * Testa se o valor do input é negativo
     *
     * @param string $inputName
     * @return bool
     */
    public static function inputNegative(string $inputName)
    {
        if (self::input($inputName) > 0) {
            return false;
        }
        return true;
    }

    /**
     * Testa se o valor do input é um valor numérico
     *
     * @param string $inputName
     * @return bool
     */
    public static function inputIsNumber(string $inputName)
    {
        if (!is_numeric(self::input($inputName))) {
            return false;
        }
        return true;
    }

    /**
     * Testa se o valor do input é do tipo file
     *
     * @param string $inputName
     * @return bool
     */
    public static function inputIsFile(string $inputName)
    {
        if (!is_file(self::input($inputName))) {
            return false;
        }
        return true;
    }

    /**
     * Testa se o conteudo vindo do nput existe e não é vazio
     *
     * @param string $inputName
     * @return bool
     */
    public static function has(string $inputName)
    {
        if (isset($_REQUEST["$inputName"]) and !empty($_REQUEST["$inputName"])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Valida os inputs de entrada via formulario
     *
     * @param string $input
     * @param string $redirect
     * @param array $rules
     * @param integer $min
     * @param integer $max
     * @param string $inputAlias
     * @return bool
     */
    public static function formValidate(string $input, string $inputAlias, array $rules, int $min = null, int $max = null)
    {
        $inputValue = $_REQUEST[$input];
        if ($inputAlias == '') {
            $inputAlias = $input;
        }
        if (in_array('required', $rules)) {
            $msg = strtr($GLOBALS['REQUIRED_VALIDATION'], [
                ':atribute' => $inputAlias,
                ':min' => $min,
                ':max' => $max
            ]);
            if (empty($inputValue)) {
                if (IS_API == 'true') {
                    Response::json(['data' => $msg]);
                }
                FlashMessage::flashMessage('errMessage', 'Opss...', $msg, 'error');
                exit;
            }
        }
        if (in_array('email', $rules)) {
            $msg = strtr($GLOBALS['EMAIL_VALIDATION'], [
                ':atribute' => $inputAlias,
                ':min' => $min,
                ':max' => $max
            ]);
            if (!Validation::isEmail($inputValue)) {
                if (IS_API == 'true') {
                    Response::json(['data' => $msg]);
                }
                FlashMessage::flashMessage('errMessage', 'Opss...', $msg, 'error');
                exit;
            }
        }

        if (in_array('number', $rules)) {
            $msg = strtr($GLOBALS['NUMBER_VALIDATION'], [
                ':atribute' => $inputAlias,
                ':min' => $min,
                ':max' => $max
            ]);
            if (!is_numeric($inputValue)) {
                if (IS_API == 'true') {
                    Response::json(['data' => $msg]);
                }
                FlashMessage::flashMessage('errMessage', 'Opss...', $msg, 'error');
                exit;
            }
        }
        if (in_array('negative', $rules)) {
            $msg = strtr($GLOBALS['NEGATIVE_VALIDATION'], [
                ':atribute' => $inputAlias,
                ':min' => $min,
                ':max' => $max
            ]);
            if (!is_numeric($inputValue) or $inputValue >= 0) {
                if (IS_API == 'true') {
                    Response::json(['data' => $msg]);
                }
                FlashMessage::flashMessage('errMessage', 'Opss...', $msg, 'error');
                exit;
            }
        }
        if (in_array('positive', $rules)) {
            $msg = strtr($GLOBALS['POSITIVE_VALIDATION'], [
                ':atribute' => $inputAlias,
                ':min' => $min,
                ':max' => $max
            ]);
            if (!is_numeric($inputValue) or $inputValue < 0) {
                if (IS_API == 'true') {
                    Response::json(['data' => $msg]);
                }
                FlashMessage::flashMessage('errMessage', 'Opss...', $msg, 'error');
                exit;
            }
        }
        if (in_array('string', $rules)) {
            $msg = strtr($GLOBALS['STRING_VALIDATION'], [
                ':atribute' => $inputAlias,
                ':min' => $min,
                ':max' => $max
            ]);
            if (!is_string($inputValue)) {
                if (IS_API == 'true') {
                    Response::json(['data' => $msg]);
                }
                FlashMessage::flashMessage('errMessage', 'Opss...', $msg, 'error');
                exit;
            }
        }
        if (in_array('min', $rules)) {
            $msg = strtr($GLOBALS['MIN_VALIDATION'], [
                ':atribute' => $inputAlias,
                ':min' => $min,
                ':max' => $max
            ]);
            if (strlen($inputValue) < $min) {
                if (IS_API == 'true') {
                    Response::json(['data' => $msg]);
                }
                FlashMessage::flashMessage('errMessage', 'Opss...', $msg, 'error');
                exit;
            }
        }
        if (in_array('max', $rules)) {
            $msg = strtr($GLOBALS['MAX_VALIDATION'], [
                ':atribute' => $inputAlias,
                ':min' => $min,
                ':max' => $max
            ]);
            if (strlen($inputValue) > $min) {
                if (IS_API == 'true') {
                    Response::json(['data' => $msg]);
                }
                FlashMessage::flashMessage('errMessage', 'Opss...', $msg, 'error');
                exit;
            }
        }
        if (in_array('between', $rules)) {
            $msg = strtr($GLOBALS['BETWEEN_VALIDATION'], [
                ':atribute' => $inputAlias,
                ':min' => $min,
                ':max' => $max
            ]);
            if ((strlen($inputValue) < $min and strlen($inputValue) > $max)) {
                if (IS_API == 'true') {
                    Response::json(['data' => $msg]);
                }
                FlashMessage::flashMessage('errMessage', 'Opss...', $msg, 'error');
                exit;
            }
        }
        return true;
    }
}
