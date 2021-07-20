<?php

use Scooby\Kernel\Cli;
use Scooby\Log\Log;

class MakeAuth
{
    public static function execOptionMakeAuth()
    {
        Cli::println('Por favor digite sua senha para dar permissão de escrita no cache da aplicação');
        shell_exec('sudo chmod 777 -R System/SysConfig/Cache');
        $userController = file_get_contents('System/Shell/templates/php_tpl/userController.tpl');
        $userController = strtr($userController, ['dateNow' => date('d-m-y - H:i:a')]);

        $dashboardController = file_get_contents('System/Shell/templates/php_tpl/dashboardController.tpl');
        $dashboardController = strtr($dashboardController, ['dateNow' => date('d-m-y - H:i:a')]);


        $userModel = file_get_contents('System/Shell/templates/php_tpl/userModel.tpl');
        $userModel = strtr($userModel, ['dateNow' => date('d-m-y - H:i:a')]);

        $passwordTokenModel = file_get_contents('System/Shell/templates/php_tpl/passwordRescueModel.tpl');
        $passwordTokenModel = strtr($passwordTokenModel, ['dateNow' => date('d-m-y - H:i:a')]);

        $loginView = file_get_contents('System/Shell/templates/twig_tpl/login.tpl');
        $loginView = strtr($loginView, ['dateNow' => date('d-m-y - H:i:a')]);

        $registerView = file_get_contents('System/Shell/templates/twig_tpl/register.tpl');
        $registerView = strtr($registerView, ['dateNow' => date('d-m-y - H:i:a')]);

        $passwordRescue = file_get_contents('System/Shell/templates/twig_tpl/passwordRescue.tpl');
        $passwordRescue = strtr($passwordRescue, ['dateNow' => date('d-m-y - H:i:a')]);

        $newPassword = file_get_contents('System/Shell/templates/twig_tpl/newPassword.tpl');
        $newPassword = strtr($newPassword, ['dateNow' => date('d-m-y - H:i:a')]);

        $dashBoardView = file_get_contents('System/Shell/templates/twig_tpl/dashboard.tpl');
        $dashBoardView = strtr($dashBoardView, ['dateNow' => date('d-m-y - H:i:a')]);

        $updateUser = file_get_contents('System/Shell/templates/twig_tpl/updateUser.tpl');
        $updateUser = strtr($updateUser, ['dateNow' => date('d-m-y - H:i:a')]);

        $routesAuth = file_get_contents('System/Shell/templates/php_tpl/routesAuth.tpl');
        $routesAuth = strtr($routesAuth, ['dateNow' => date('d-m-y - H:i:a')]);

        $navbar = file_get_contents('System/Shell/templates/twig_tpl/navbar.tpl');
        $navbar = strtr($navbar, ['dateNow' => date('d-m-y - H:i:a')]);

        $authConfig = file_get_contents('.env');

        if (file_exists("App/Controllers/UserController.php")) {
            Log::log('Controller UserController já existente na pasta App/Controllers');
            Cli::println("ERROR: Controller UserController já existente na pasta 'App/Controllers'");
            return;
        }
        if (file_exists("App/Controllers/DashboardController.php")) {
            Log::log('Controller UserController já existente na pasta App/Controllers');
            Cli::println("ERROR: Controller UserController já existente na pasta 'App/Controllers'");
            return;
        }
        if (file_exists("App/Models/User.php")) {
            Log::log('Model User já existente na pasta App/Models');
            Cli::println("ERROR: Model User já existente na pasta 'App/Models'");
            return;
        }
        if (file_exists("App/Models/Authorization.php")) {
            Log::log('Model User já existente na pasta App/Models');
            Cli::println("ERROR: Model User já existente na pasta 'App/Models'");
            return;
        }
        if (file_exists("App/Models/LoggedToken.php")) {
            Log::log('Model User já existente na pasta App/Models');
            Cli::println("ERROR: Model User já existente na pasta 'App/Models'");
            return;
        }
        if (file_exists("App/Views/Pages/Login.twig")) {
            Log::log('View Login já existente na pasta App/Views/Pages');
            Cli::println("ERROR: View Login já existente na pasta 'App/Views/Pages'");
            return;
        }
        if (file_exists("App/Views/Pages/Register.twig")) {
            Log::log('View Register já existente na pasta App/Views/Pages');
            Cli::println("ERROR: View Register já existente na pasta 'App/Views/Pages'");
            return;
        }
        if (file_exists("App/Views/Pages/passwordRescue.twig")) {
            Log::log('View Password Rescue já existente na pasta App/Views/Pages');
            Cli::println("ERROR: View Password Rescue já existente na pasta 'App/Views/Pages'");
            return;
        }
        if (file_exists("App/Views/Pages/NewPassword.twig")) {
            Log::log('View New Password Rescue já existente na pasta App/Views/Pages');
            Cli::println("ERROR: View New Password Rescue já existente na pasta 'App/Views/Pages'");
            return;
        }
        $f = fopen("App/Controllers/UserController.php", 'w+');
        if ($f == false) {
            Log::log('Um erro desconhecido ocorreu ao criar o UserController');
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        $fw = fwrite($f, $userController);
        if ($fw == false) {
            Log::log('Um erro desconhecido ocorreu ao criar o UserController');
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fclose($f);
        Log::log('UserController criado em App/Controllers com sucesso.');
        Cli::println("UserController criado em 'App/Controllers' com sucesso.");
        $f = fopen("App/Controllers/DashboardController.php", 'w+');
        if ($f == false) {
            Log::log('Um erro desconhecido ocorreu, por favor tente novamente');
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        $fw = fwrite($f, $dashboardController);
        if ($fw == false) {
            Log::log('Um erro desconhecido ocorreu ao criar o DashboardController');
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fclose($f);
        Log::log("DashboardController criado em 'App/Controllers' com sucesso.");
        Cli::println("DashboardController criado em 'App/Controllers' com sucesso.");
        $f = fopen("App/Models/User.php", 'w+');
        if ($f == false) {
            Log::log('Um erro desconhecido ocorreu ao crir user model');
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        $fw = fwrite($f, $userModel);
        if ($fw == false) {
            Log::log('Um erro desconhecido ocorreu ao criar user model');
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        Log::log("User model criado em 'App/Models' com sucesso.");
        fclose($f);
        $f = fopen("App/Models/PasswordUserToken.php", 'w+');
        if ($f == false) {
            Log::log("Um erro desconhecido ocorreu ao criar PasswordUserToken");
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        $fw = fwrite($f, $passwordTokenModel);
        if ($fw == false) {
            Log::log("Um erro desconhecido ocorreu ao criar PasswordUserToken");
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        Log::log("PasswordUserToken criado em 'App/Models' com sucesso.");
        fclose($f);
        Cli::println("PasswordUserToken criado em 'App/Models' com sucesso.");
        $f = fopen("App/Views/Pages/Login.twig", 'w+');
        if ($f == false) {
            Log::log("Um erro desconhecido ocorreu ao criar a view Login");
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        $fw = fwrite($f, $loginView);
        if ($fw == false) {
            Log::log("Um erro desconhecido ocorreu ao criar a view Login");
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fclose($f);
        Log::log("Login criado em 'App/Views/Pages' com sucesso.");
        Cli::println("Login criado em 'App/Views/Pages' com sucesso.");
        $f = fopen("App/Views/Pages/Register.twig", 'w+');
        if ($f == false) {
            Log::log("Um erro desconhecido ocorreu ao criar a view register");
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        $fw = fwrite($f, $registerView);
        if ($fw == false) {
            Log::log("Um erro desconhecido ocorreu ao criar a view register");
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fclose($f);
        Cli::println("Register criado em 'App/Views/Pages' com sucesso.");
        Log::log("Register criado em 'App/Views/Pages' com sucesso.");
        $f = fopen("App/Views/Pages/PasswordRescue.twig", 'w+');
        if ($f == false) {
            Log::log("Um erro desconhecido ocorreu ao criar a view passwordRescue");
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        $fw = fwrite($f, $passwordRescue);
        if ($fw == false) {
            Log::log("Um erro desconhecido ocorreu ao criar a view passwordRescue");
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fclose($f);
        Cli::println("PasswordRescue criado em 'App/Views/Pages' com sucesso.");
        Log::log("PasswordRescue criado em 'App/Views/Pages' com sucesso.");
        $f = fopen("App/Views/Pages/NewPassword.twig", 'w+');
        if ($f == false) {
            Log::log("Um erro desconhecido ocorreu ao criar a newPassword");
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        $fw = fwrite($f, $newPassword);
        if ($fw == false) {
            Log::log("Um erro desconhecido ocorreu ao criar a newPassword");
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fclose($f);
        Cli::println("NewPassword criado em 'App/Views/Pages' com sucesso.");
        Log::log("NewPassword criado em 'App/Views/Pages' com sucesso.");
        $f = fopen("App/Views/Pages/DashBoard.twig", 'w+');
        if ($f == false) {
            Log::log("Um erro desconhecido ocorreu ao criar a view dashboard");
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        $fw = fwrite($f, $dashBoardView);
        if ($fw == false) {
            Log::log("Um erro desconhecido ocorreu ao criar a view dashboard");
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fclose($f);
        Cli::println("DashBoard criado em 'App/Views/Pages' com sucesso.");
        Log::log("DashBoard criado em 'App/Views/Pages' com sucesso.");
        $f = fopen("App/Views/Pages/UpdateUser.twig", 'w+');
        if ($f == false) {
            Log::log("Um erro desconhecido ocorreu ao criar a view updateUser");
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        $fw = fwrite($f, $updateUser);
        if ($fw == false) {
            Log::log("Um erro desconhecido ocorreu ao criar a view updateUser");
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fclose($f);
        Cli::println("UpdateUser criado em 'App/Views/Pages' com sucesso.");
        Log::log("UpdateUser criado em 'App/Views/Pages' com sucesso.");
        $f = fopen("App/Routes/web.php", 'a+');
        if ($f == false) {
            Log::log("Um erro desconhecido ocorreu ao criar o arquivo de rotas WEB");
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        $fw = fwrite($f, $routesAuth);
        if ($fw == false) {
            Log::log("Um erro desconhecido ocorreu ao criar o arquivo de rotas WEB");
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fclose($f);
        Cli::println("Rotas de Autenticação criadas em 'App/Routes/web.php' com sucesso.");
        Log::log("Rotas de Autenticação criadas em 'App/Routes/web.php' com sucesso.");
        $f = fopen("App/Views/Pages/Home.twig", 'w+');
        if ($f == false) {
            Log::log("Um erro desconhecido ocorreu ao alterar a view home");
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        $fw = fwrite($f, $navbar);
        if ($fw == false) {
            Log::log("Um erro desconhecido ocorreu ao alterar a view home");
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fclose($f);
        Cli::println("Navbar criado em 'App/Views/Pages/Home.twig' com sucesso.");
        Log::log("Navbar criado em 'App/Views/Pages/Home.twig' com sucesso.");
        $f = fopen(".env", 'w+');
        if ($f == false) {
            Log::log("Um erro desconhecido ocorreu ao atrerar o arquivo .env");
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        $authConfig = strtr($authConfig, [
            'VIEWS_AUTH=' => 'VIEWS_AUTH=Dashboard,UpdateUser,'
        ]);
        $fw = fwrite($f, $authConfig);
        if ($fw == false) {
            Log::log("Um erro desconhecido ocorreu ao alterar o arquivo .env");
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fclose($f);
        Cli::println(".env alterado com sucesso.");
        Log::log(".env alterado com sucesso.");
        $migrationUser = shell_exec("php vendor/robmorgan/phinx/bin/phinx create CreateUserAuth --template='System/Shell/templates/migrations_tpl/migration_user_auth_template.tpl'");
        sleep(1);
        $migrationPasswordRescue = shell_exec("php vendor/robmorgan/phinx/bin/phinx create PasswordRescue --template='System/Shell/templates/migrations_tpl/migration_user_password_rescue_template.tpl'");
        if ($migrationUser) {
            Cli::println("Migration UserAuth criada com sucess");
            Log::log("Migration UserAuth criada com sucess");
        }
        if ($migrationPasswordRescue) {
            Cli::println("Migration PasswordRescue criada com sucess");
            Log::log("Migration PasswordRescue criada com sucess");
        }
        $seed = file_get_contents('System/Shell/templates/seeds_tpl/SeedUserAuth.tpl');
        $seed = strtr($seed, ['dateNow' => date('d-m-y - H:i:a')]);
        $f = fopen("App/Db/Seeds/SeedUserAuth.php", 'w+');
        if ($f == false) {
            Log::log("Um erro desconhecido ocorreu ao criar a seed seedUserAuth");
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        $fw = fwrite($f, $seed);
        if ($fw == false) {
            Log::log("Um erro desconhecido ocorreu ao criar a seed seedUserAuth");
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fclose($f);
        //$migrate = shell_exec("php vendor/robmorgan/phinx/bin/phinx migrate");
        Cli::println("SeedUserAuth criada com sucesso em App/Db/Seeds/" . PHP_EOL);
        Log::log("SeedUserAuth criada com sucesso em App/Db/Seeds/" . PHP_EOL);
        Cli::println("\033[1;96m -> [ATENÇÃO] Antes de executar as MIGRATIONS verifique se não deseja alterar suas estruturas em App/Db/Migrations, após isso execute as migrations com o comando MIGRATE via scooby-do" . PHP_EOL);
        exit;
    }

    public static function execOptionMakeAuthApi()
    {
        Cli::println('Por favor digite sua senha para dar permissão de escrita no cache da aplicação');
        shell_exec('sudo chmod 777 -R System/SysConfig/Cache');
        $userController = file_get_contents('System/Shell/templates/php_tpl/userApiController.tpl');
        $userController = strtr($userController, ['dateNow' => date('d-m-y - H:i:a')]);

        $userModel = file_get_contents('System/Shell/templates/php_tpl/userModel.tpl');
        $userModel = strtr($userModel, ['dateNow' => date('d-m-y - H:i:a')]);

        $loggedModel = file_get_contents('System/Shell/templates/php_tpl/LoggedTokens.tpl');
        $loggedModel = strtr($loggedModel, ['dateNow' => date('d-m-y - H:i:a')]);

        $authModel = file_get_contents('System/Shell/templates/php_tpl/Authorization.tpl');
        $authModel = strtr($authModel, ['dateNow' => date('d-m-y - H:i:a')]);

        $passwordTokenModel = file_get_contents('System/Shell/templates/php_tpl/passwordRescueModel.tpl');
        $passwordTokenModel = strtr($passwordTokenModel, ['dateNow' => date('d-m-y - H:i:a')]);

        $routesAuth = file_get_contents('System/Shell/templates/php_tpl/routesApiAuth.tpl');
        $routesAuth = strtr($routesAuth, ['dateNow' => date('d-m-y - H:i:a')]);

        if (file_exists("App/Controllers/UserApiController.php")) {
            Cli::println("ERROR: Controller UserApiController já existente na pasta 'App/Controllers'");
            Log::log("ERROR: Controller UserApiController já existente na pasta 'App/Controllers'");
            return;
        }

        if (file_exists("App/Models/User.php")) {
            Cli::println("ERROR: Model User já existente na pasta 'App/Models'");
            Log::log("ERROR: Model User já existente na pasta 'App/Models'");
            return;
        }

        $f = fopen("App/Controllers/UserApiController.php", 'w+');
        if ($f == false) {
            Log::log("Um erro desconhecido ocorreu ao criar o UserApiController");
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        $fw = fwrite($f, $userController);
        if ($fw == false) {
            Log::log("Um erro desconhecido ocorreu ao criar o UserApiController");
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fclose($f);
        Cli::println("UserApiController criado em 'App/Controllers' com sucesso.");
        Log::log("UserApiController criado em 'App/Controllers' com sucesso.");
        $f = fopen("App/Models/User.php", 'w+');
        if ($f == false) {
            Log::log("Um erro desconhecido ocorreu ao criar o user model");
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        $fw = fwrite($f, $userModel);
        if ($fw == false) {
            Log::log("Um erro desconhecido ocorreu ao criar o user model");
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fclose($f);
        Cli::println("User model criado em 'App/Models' com sucesso.");
        $f = fopen("App/Models/Authorization.php", 'w+');
        if ($f == false) {
            Log::log('Um erro desconhecido ocorreu ao crir user model');
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        $fw = fwrite($f, $authModel);
        if ($fw == false) {
            Log::log('Um erro desconhecido ocorreu ao criar user model');
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        Log::log("Authorization model criado em 'App/Models' com sucesso.");
        $f = fopen("App/Models/LoggedTokens.php", 'w+');
        if ($f == false) {
            Log::log('Um erro desconhecido ocorreu ao crir user model');
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        $fw = fwrite($f, $loggedModel);
        if ($fw == false) {
            Log::log('Um erro desconhecido ocorreu ao criar user model');
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        Log::log("LoggedTokens model criado em 'App/Models' com sucesso.");
        Log::log("User model criado em 'App/Models' com sucesso.");
        $f = fopen("App/Models/PasswordUserToken.php", 'w+');
        if ($f == false) {
            Log::log("Um erro desconhecido ocorreu ao criar PasswordUserToken");
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        $fw = fwrite($f, $passwordTokenModel);
        if ($fw == false) {
            Log::log("Um erro desconhecido ocorreu ao criar PasswordUserToken");
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fclose($f);
        Cli::println("PasswordUserToken criado em 'App/Models' com sucesso.");
        Log::log("PasswordUserToken criado em 'App/Models' com sucesso.");
        $f = fopen("App/Routes/api.php", 'a+');
        if ($f == false) {
            Log::log("Um erro desconhecido ocorreu ao criar o arquivo de rotas API");
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        $fw = fwrite($f, $routesAuth);
        if ($f == false) {
            Log::log("Um erro desconhecido ocorreu ao criar o arquivo de rotas API");
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fclose($f);
        Cli::println("Rotas de Autenticação criadas em 'App/Routes/api.php' com sucesso.");
        Log::log("Rotas de Autenticação criadas em 'App/Routes/api.php' com sucesso.");
        $migrationUser = shell_exec("php vendor/robmorgan/phinx/bin/phinx create CreateUserAuth --template='System/Shell/templates/migrations_tpl/migration_user_auth_template.tpl'");
        sleep(1);
        $migrationPasswordRescue = shell_exec("php vendor/robmorgan/phinx/bin/phinx create PasswordRescue --template='System/Shell/templates/migrations_tpl/migration_user_password_rescue_template.tpl'");
        sleep(1);
        $migrationLoggedToken = shell_exec("php vendor/robmorgan/phinx/bin/phinx create LoggedTokens --template='System/Shell/templates/migrations_tpl/loggedToken.tpl'");
        sleep(1);
        $migrationExpiredToken = shell_exec("php vendor/robmorgan/phinx/bin/phinx create ExpiredToken --template='System/Shell/templates/migrations_tpl/expiredToken.tpl'");
        if ($migrationUser) {
            Cli::println("Migration UserAuth criada com sucess");
            Log::log("Migration UserAuth criada com sucess");
        }
        if ($migrationPasswordRescue) {
            Cli::println("Migration PasswordRescue criada com sucess");
            Log::log("Migration PasswordRescue criada com sucess");
        }
        if ($migrationLoggedToken) {
            Cli::println("Migration LoggedTokens criada com sucess");
            Log::log("Migration LoggedTokens criada com sucess");
        }
        if ($migrationExpiredToken) {
            Cli::println("Migration ExpiredToken criada com sucess");
            Log::log("Migration ExpiredToken criada com sucess");
        }
        $seed = file_get_contents('System/Shell/templates/seeds_tpl/SeedUserAuth.tpl');
        $seed = strtr($seed, ['dateNow' => date('d-m-y - H:i:a')]);
        $f = fopen("App/Db/Seeds/SeedUserAuth.php", 'w+');
        if ($f == false) {
            Log::log("Um erro desconhecido ocorreu ao criar a seedUserAuth");
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        $fw = fwrite($f, $seed);
        if ($fw == false) {
            Log::log("Um erro desconhecido ocorreu ao criar a seedUserAuth");
            Cli::println('Um erro desconhecido ocorreu, por favor tente novamente');
            return;
        }
        fclose($f);
        Cli::println("SeedUserAuth criada com sucesso em App/Db/Seeds/" . PHP_EOL);
        Log::log("SeedUserAuth criada com sucesso em App/Db/Seeds/" . PHP_EOL);
        Cli::println("\033[1;96m -> [ATENÇÃO] Antes de executar as MIGRATIONS verifique se não deseja alterar suas estruturas em App/Db/Migrations, após isso execute as migrations com o comando MIGRATE via scooby-do" . PHP_EOL);
        exit;
    }
}
