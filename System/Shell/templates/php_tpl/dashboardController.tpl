<?php

//Controller gerado automaticamente via - Scooby-CLI em dateNow

namespace Scooby\Controllers;

use Scooby\Models\User;
use Scooby\Helpers\FlashMessage;
use Scooby\Helpers\Login;
use Scooby\Helpers\Session;
use Scooby\Http\Request;


class DashboardController extends Controller
{
   public function index(): void
   {
        $userInfo = (Login::userInfo());
        FlashMessage::getFlashMessage('error');
    	$this->view("Pages", "DashBoard", ['userName' => $userInfo->userName]);
   }

    /**
     * Faz o logout do usuario
     *
     * @return void
     */
    public function exit(): void
    {
        Login::sessionLoginDestroyWithRedirect("login");
    }

     /**
     * Deleta o usuario logado
     *
     * @param integer $id
     * @return void
     */
    public function deleteUser(): void
    {
        $id = $_SESSION['id'];
        $user = new User;
        $u = $user->find($id);
        $u->delete();
        $this->exit();
    }
    /**
     * Busca as informações dos usuario e chama a view de edição
     *
     * @return void
     */
    public function alterUser(): void
    {
        $id = Session::getSession('id');
        $user = new User;
        $u = $user->find($id);
        if ($u == null) {
            $this->view('pages', 'Dashboard', [
                'msg' => FlashMessage::toast('Error:', $GLOBALS['SOMETHING_WRONG'], 'error')
            ]);
            exit;
        }
        $this->view('pages', 'UpdateUser', [
            'name' => $u->name,
            'email' => $u->email
        ]);
    }

    /**
     * Atualiza as informações do usuario
     *
     * @return void
     */
    public function updateUser(Request $request): void
    {
        $id = Session::getSession('id');
        $name = $request->getRequest()->name;
        $email = $request->getRequest()->email;
        $password = $request->getRequest()->pass;
        $user =  new User;
        $u = $user->find($id);
        if (empty($password)) {
            $u->name = $name;
            $u->email = $email;
            $u->save();
            FlashMessage::flashMessage('error', 'Ok...', $GLOBALS['UPDATE_DATA_SUCCESS'], 'success', 'dashboard');
            exit;
        }if (empty($name)) {
            $u->password = Login::passwordHash($password);
            $u->email = $email;
            $u->save();
            FlashMessage::flashMessage('error', 'Ok...', $GLOBALS['UPDATE_DATA_SUCCESS'], 'success', 'dashboard');
            exit;
        }elseif (empty($email)) {
            $u->name = $name;
            $u->password = Login::passwordHash($password);
            $u->save();
            FlashMessage::flashMessage('error', 'Ok...', $GLOBALS['UPDATE_DATA_SUCCESS'], 'success', 'dashboard');
            exit;
        }elseif (empty($password)) {
            $u->name = $name;
            $u->email = $email;
            $u->save();
            FlashMessage::flashMessage('error', 'Ok...', $GLOBALS['UPDATE_DATA_SUCCESS'], 'success', 'dashboard');
            exit;
        }
        $u->name = $name;
        $u->email = $email;
        $u->password = Login::passwordHash($password);
        $u->save();
        FlashMessage::flashMessage('error', 'Ok...', $GLOBALS['UPDATE_DATA_SUCCESS'], 'success', 'dashboard');
        exit;
    }
}
