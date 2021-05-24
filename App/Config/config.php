<?php

date_default_timezone_set('America/Sao_Paulo');

// Configurações do banco de dados e smtp do projeto rodando em produção
if (getenv('ENV') == 'production') {

    error_reporting(0);

    //define a url base do sistema
    define("BASE_URL", getenv('PROD_ROOT_PATH'));

    //url base do sistema
    define("ROUTE", getenv('PROD_ROUTE'));

    // Nome dado a rota de erro http
    define('ROUTE_ERROR', getenv('PROD_ROUTE_ERROR'));

    define('ROOT_PATH', (getenv('PROD_ROOT_PATH') !== '/') ? getenv('ROOT_PATH') : '');

    //Define o nome do banco de dados a ser usado em produção
    define('DB_NAME', getenv('PROD_DB_NAME'));

    //Define o usuário do banco de dados em produção
    define('DB_USER', getenv('PROD_DB_USER'));

    //Define a senha do usuário do banco de dados em produção
    define('DB_PASS', getenv('PROD_DB_PASS'));

    //Define o driver de banco de dados
    define('DB_DRIVER', getenv('PROD_DB_DRIVER'));

    //Define o host do banco de dados em desenvolvimento
    define('DB_HOST', getenv('PROD_DB_HOST'));

    //Define o charset para utf8
    define('CHARSET', getenv('PROD_CHARSET'));

    //Opções adicionais do DB
    define('DB_OPTIONS', [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    //Define a collation para utf8 general ci
    define('COLLATION', getenv('PROD_COLLATION'));

    //Define o endereço do servidor de email a ser utilizado em modo de produção
    define('SMTP', getenv('PROD_SMTP'));

    //Define o usuario do servidor de email em modo de produção
    define('SMTP_USER', getenv('PROD_SMTP_USER'));

    //Define a senha do usuario do servidor de email em modo de produção
    define('SMTP_PASS', getenv('PROD_SMTP_PASS'));

    //define a porta do servidor de email em modo de produção
    define('SMTP_PORT', getenv('PROD_SMTP_PORT'));

    //Define o certificado a ser usuado no tranporte do email ex: ssl ou tls em modo de produção
    define('SMTP_CETTIFICATE', getenv('PROD_SMTP_CETTIFICATE'));

    // Configurações do banco de dados e smtp do projeto rodando em desenvolvimento
} else if (getenv('ENV') == 'development') {

    error_reporting(E_ALL);

    //define a url base do sistema
    define("BASE_URL", getenv('ROOT_PATH'));

    //url base do sistema
    define("ROUTE", getenv('ROUTE'));

    // Nome dado a rota de erro http
    define('ROUTE_ERROR', getenv('ROUTE_ERROR'));

    define('ROOT_PATH', (getenv('ROOT_PATH') !== '/') ? getenv('ROOT_PATH') : '');

    //Define o nome do banco de dados a ser usado em desenvolvimento
    define('DB_NAME', getenv('DB_NAME'));

    //Define o usuário do banco de dados em desenvolvimento
    define('DB_USER', getenv('DB_USER'));

    //Define a senha do usuário do banco de dados em desenvolvimento
    define('DB_PASS', getenv('DB_PASS'));

    //Define o driver de banco de dados
    define('DB_DRIVER', getenv('DB_DRIVER'));

    //Define o host do banco de dados em desenvolvimento
    define('DB_HOST', getenv('DB_HOST'));

    //Define o charset para utf8
    define('CHARSET', getenv('CHARSET'));

    //Opções adicionais do DB
    define('DB_OPTIONS', [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    //Define a collation para utf8 general ci
    define('COLLATION', getenv('COLLATION'));

    //Define o endereço do servidor de email a ser utilizado em modo de desenvolvimento
    define('SMTP', getenv('SMTP'));

    //Define o usuario do servidor de email em modo de desenvolvimento
    define('SMTP_USER', getenv('SMTP_USER'));

    //Define a senha do usuario do servidor de email em modo de desenvolvimento
    define('SMTP_PASS', getenv('SMTP_PASS'));

    //define a porta do servidor de email em modo de desenvolvimento
    define('SMTP_PORT', getenv('SMTP_PORT'));

    //Define o certificado a ser usuado no tranporte do email ex: ssl ou tls em modo de desenvolvimento
    define('SMTP_CETTIFICATE', getenv('SMTP_CETTIFICATE'));

}
// Log interno do framework
define('LOG', getenv('LOG'));

define('SSL_VERIFY', getenv('SSL_VERIFY'));

define('ENV', getenv('ENV'));

// Definir se a aplicação será uma API ou um projeto WEB monolítico
define('IS_API', getenv('IS_API'));

// Hash para encriptação do jwt unico, gerado ao criar o projeto
define('SECRET_KEY', getenv('SECRET_KEY'));

define('ORIGIN_ALLOW', getenv('ORIGIN_ALLOW'));

define('METHODS_ALLOW', getenv('METHODS_ALLOW'));

define('CREDENTIALS_ALLOW', getenv('CREDENTIALS_ALLOW'));

//define o nome do site em desenvolvimento
define('APP_NAME', getenv('APP_NAME'));

//define o idioma das menssagens exibidas automaticamente pelo o frameowok em desenvolvimento
define('SITE_LANG', getenv('SITE_LANG'));

define('ASSETS_VERSION', getenv('ASSETS_VERSION'));

define('ASSETS_HASH', '-' . md5(ASSETS_VERSION));

//define a url para a pasta node_modules
define("NODE_MODULES", ROOT_PATH . getenv('NODE_MODULES'));

//define a url para a pasta assets
define("ASSET", ROOT_PATH . getenv('ASSET'));

// Icone do site a ser desenvolvido
define('SITE_ICON', ROOT_PATH . getenv('SITE_ICON'));

// Descrição do site a ser criado
define('SITE_DESCRIPTION', getenv('SITE_DESCRIPTION'));

// Defina as palavras chave do seu projeto
$arr = explode(',', getenv('KEYWORDS'));
$words = [];
foreach ($arr as $word) {
    $words[] = $word;
}

define('KEYWORDS', $words);

define('COLLECTIONS_SUPPORT', getenv('COLLECTIONS_SUPPORT'));
