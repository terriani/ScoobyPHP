<?php

namespace Scooby\Helpers;

use PDO;
use Dotenv\Dotenv;

class Seeders
{


    /**
     * Roda uma seed semeando o banco de dados com dados fakes
     *
     * @param string $table
     * @param array $arr
     * @return string|bool
     */
    public function Seed($table, $arr = [])
    {
        if (!empty($_SERVER['HTTP_USER_AGENT'])) {
            return ("ERROR: Um erro desconhecido ocorreu.");
        }

        require_once '../../../vendor/autoload.php';
        require_once '../../../App/Config/config.php';
        $dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
        $dotenv->load();


        $conn = new PDO(getenv('DB_DRIVER').":host=".getenv('DB_HOST').";dbname=".getenv('DB_NAME')."", getenv('DB_USER'), getenv('DB_PASS'), [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);
        //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $fieldsList = '';
        $valuesList = '';
        $sql = "insert into " . $table . " (";
        foreach ($arr as $field => $value) {
            $fieldsList .= "$field,";
            $valuesList .= "'$value',";
        }
        $fieldsList = substr($fieldsList, 0, -1);
        $valuesList = substr($valuesList, 0, -1);
        $sql .= $fieldsList . ") values (" . $valuesList . ")";
        if (!$conn->query($sql)) {
            return false;
        }
        return true;
    }
}
