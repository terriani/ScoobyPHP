<?php

//Controller de autenticação gerado automaticamente via Scooby-CLI em dateNow

namespace Scooby\Controllers;

use Scooby\Guard\Jwt;
use Scooby\Helpers\Login;
use Scooby\Http\Request;
use Scooby\Helpers\Validation;
use Scooby\Models\LoggedTokens;
use Scooby\Models\PasswordUserToken;
use Scooby\Models\User;

class UserApiController extends Controller
{
    /**
     * Registra um novo usuario
     *
     * @return void
     */
    public function register(Request $request): void
    {
        $data = $request->getRequest;
        if (!Validation::emailMatch($data->email, 'users', 'email')) {
            $this->json(['data' => 'Email já cadastrado, por favor tente com um email diferente']);
        }
        $user = new User;
        $user->name = $data->name;
        $user->email = $data->email;
        $user->password = Login::passwordHash($data->pass);
        $user->save();
        $this->json(['data' => 'Usuário salvo com sucesso']);
    }

    /**
     * Efetua o login
     *
     * @return void
     */
    public function login(Request $request): void
    {
        $data = $request->getRequest;
        if (Login::loginValidate($data->email, $data->pass)) {
            $getJwtData = Jwt::jwtCreate(['id' => $_SESSION['id'], 'email' => $data->email]);
            $token = $getJwtData->jwt;
            $key = $getJwtData->key;
            if (Jwt::jwtExistsTokenInExpiredDb($token)) {
                $token = Jwt::jwtRefresh($token);
            }
            $logged = new LoggedTokens;
            $logged->token = $token;
            $logged->user_agent = (!empty($data->user_agent)) ? $data->user_agent : null;
            $logged->created_at = date('Y-m-d H:i:s');
            $logged->user_id = $_SESSION['id'];
            $logged->ip = $_SERVER['REMOTE_ADDR'];
            $logged->app_key = $key;
            $logged->logged_id = (!empty($data->logged_id)) ? $data->logged_id : uniqid();
            $logged->save();
            $user = User::find($_SESSION['id'])->get();
            $this->json(['data' => $token, 'user' => $user]);
        } else {
            $this->json(['data' => 'Usuário ou senha incorretos']);
        }
    }

    /**
     * Deleta usuario
     *
     * @return void
     */
    public function delete(): void
    {
        Jwt::jwtValidate(Jwt::jwtGetToken());
        $data = Jwt::jwtPayloadDecode(Jwt::jwtGetToken());
        $user = User::find($data->id);
        if ($user->delete()) {
            Jwt::jwtExpire(Jwt::jwtGetToken());
            $this->json(['data' => 'Usuário deletado com sucesso']);
        }
        $this->json(['data' => 'Falha ao deletar usuário']);
    }

    /**
     * Executa o logout do usuário
     *
     * @return void
     */
    public function logout(): void
    {
       Jwt::jwtValidate(Jwt::jwtGetToken());
       Jwt::jwtExpire(Jwt::jwtGetToken());
       $logged = new LoggedTokens;
       $logged->where('token', Jwt::jwtGetToken())->delete();
       $this->json(['data' => true]);
    }

    /**
     * Executa o logout do usuário
     *
     * @return void
     */
    public function remoteLogout(Request $request): void
    {
       Jwt::jwtValidate(Jwt::jwtGetToken());
       $token = $request->getRequest->remoteToken;
       Jwt::jwtExpire($token);
       $logged = new LoggedTokens;
       $loggedId = $logged->where('token', $token)->get()->first()->toArray();
       $logged->where('token', $token)->delete();
       $this->json(['data' => $loggedId['logged_id']]);
    }

    /**
     * Retorna os dados do usuario
     *
     * @return void
     */
    public function update(): void
    {
        Jwt::jwtValidate(Jwt::jwtGetToken());
        $id = Jwt::jwtPayloadDecode(Jwt::jwtGetToken())->id;
        $user = new User;
        $u = $user->find($id);
        if ($u == null) {
            $this->json(['data' => $GLOBALS['SOMETHING_WRONG']]);
        }
        $this->json([
            'name' => $u->name,
            'email' => $u->email
        ]);
    }

    /**
     * Altera o usuario logado no sistema
     *
     * @return void
     */
    public function alter(Request $request): void
    {
        Jwt::jwtValidate(Jwt::jwtGetToken());
        $data = $request->getRequest;
        $user = new User;
        $u = $user->find(Jwt::jwtPayloadDecode(Jwt::jwtGetToken())->id);
        if (empty($data->name)) {
            $data->name = $u->name;
        }
        if (empty($data->email)) {
            $data->email = $u->email;
        }
        if (empty($data->pass)) {
            $data->pass = $u->password;
        }
        $u->name = $data->name;
        $u->email = $data->email;
        $u->password = $data->pass;
        if (!$u->save()) {
            $this->json(['data' => $GLOBALS['SOMETHING_WRONG']]);
        }
        $this->json(['data' => $GLOBALS['UPDATE_DATA_SUCCESS'], 'user' => $user->find(Jwt::jwtPayloadDecode(Jwt::jwtGetToken())->id)->get()]);
    }

    public function passwordRescue (Request $request)
    {
        $data = $request->getRequest;
        $email = $data->email;
        $token = $data->token;
        if (Validation::emailMatch($email, 'users', 'email')) {
            $this->json([
                'status' => false,
                'data' => 'Email Não existente em nossa base de dados'
            ]);
        }
        $user = new User;
        $u = $user->where('email', $email)->first();
        $newPass = new PasswordUserToken;
        $newPass->user_id = $u->id;
        $newPass->token = $token;
        $newPass->used = 0;
        $newPass->save();
        $this->json([
            'status' => true,
            'UserName' => $u->name
        ]);
    }

    public function tokenValidate(Request $request)
    {
        $data = $request->getRequest;
        $token = $data->token;
        $tokenUsed = new PasswordUserToken;
        $used = $tokenUsed->where('token', $token)->first();
        if ($used->used != 0) {
            $this->json([
                'status' => false,
                'data' => 'Token Inválido'
            ]);
        }
        $this->json([
            'status' => true
        ]);
    }

    public function updatePassword(Request $request)
    {
        $data = $request->getRequest;
        $newPass = new PasswordUserToken;
        $p = $newPass->where('token', $data->token)->first();
        $p->used = 1;
        $p->save();
        $user = new User;
        $id = $p->user_id;
        $u = $user->where('id', $id)->update(['password' => Login::passwordHash($data->newPassword)]);
        if (!$u or !$p)
        {
            $this->json([
                'status' => false
            ]);
        }
        $this->json([
            'status' => true
        ]);
    }

    public function getUserName(Request $request)
    {
        Jwt::jwtValidate(Jwt::jwtGetToken());
        $id = null;
        if (empty($request->getRequest->id)) {
            $id = Jwt::jwtPayloadDecode(Jwt::jwtGetToken())->id;
        } else {
            $id = $request->getRequest->id;
        }
        $user = new User;
        $name = $user->find($id);
        if (!$name) {
            $this->json([
                'status' => false
            ]);
        }
        $this->json([
            'ownerName' => $name->name
        ]);
    }

    public function getUserEmail(Request $request)
    {
        Jwt::jwtValidate(Jwt::jwtGetToken());
        $id = null;
        if (empty($request->getRequest->id)) {
            $id = Jwt::jwtPayloadDecode(Jwt::jwtGetToken())->id;
        } else {
            $id = $request->getRequest->id;
        }
        $user = new User;
        $email = $user->find($id);
        if (!$email) {
            $this->json([
                'status' => false
            ]);
        }
        $this->json([
            'ownerEmail' => $email->email
        ]);
    }

    public function getLoggedUsers()
    {
        Jwt::jwtValidate(Jwt::jwtGetToken());
        $id = Jwt::jwtPayloadDecode(Jwt::jwtGetToken())->id;

        $logged = new LoggedTokens;
        $this->json(['logged' => $this->normalizeDate($logged->where('user_id', $id)->get()->toArray(), Jwt::jwtGetToken())]);
    }

    private function normalizeDate(array $data, string $token)
    {
        for ($i = 0; $i < count($data); $i++) {
            foreach ($data[$i] as $key => $value) {
                $data[$i]['isLogged'] = false;
                if ($key == 'created_at') {
                    $date = explode(' ', $value);
                    $data[$i][$key] = date('d/m/Y', strtotime($date[0])) . ' - ' . $date[1];
                }
                if ($data[$i]['token'] === $token) {
                    $data[$i]['isLogged'] = true;
                }
            }
        }
        return $data;
    }
}