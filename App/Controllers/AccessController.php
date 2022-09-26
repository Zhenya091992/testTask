<?php

namespace App\Controllers;

use App\Config;
use App\JsonStorage;
use App\Validators\Rules\AuthRule;
use App\Validators\Rules\RegisterRule;
use App\Models\User;

class AccessController extends Controller
{
    public function registration($errors)
    {
        $this->view->display('registration/content.twig', $errors ?? []);
    }

    public function register()
    {
        $this->request->setData($_POST);
        $rule = new RegisterRule();
        $errors = $rule->validate($this->request);
        if ($errors) {
            echo json_encode(['err' => $errors]);
            return;
        }

        $user = new User();
        $user->login = $this->request->getData('login');
        $user->name = $this->request->getData('name');
        $user->email = $this->request->getData('email');
        $user->password = $this->request->getData('password');
        $remember = $this->request->getData('remember');
        $user->save();
        $user->authenticate(!empty($remember));


        echo json_encode(['success' => 'success']);
    }

    public function authentication()
    {
        $this->view->display('authentication/content.twig', []);
    }

    public function authenticate()
    {
        $this->request->setData($_POST);
        $rule = new AuthRule();
        $errors = $rule->validate($this->request);
        if ($errors) {
            echo json_encode(['err' => $errors]);
            return;
        }

        $user = User::checkPassword($this->request->getData('login'), $this->request->getData('password'));

        if ($user) {
            $remember = $this->request->getData('remember');
            $user->authenticate($remember);
            echo json_encode(['success' => 'success']);
            return;
        }

        echo json_encode(['err' => ['fail' => 'wrong login or password']]);
    }

    public function userExit()
    {
        if ($this->auth) {
            $this->auth->unlog();
        }
        $this->router->routing('/Authentication');
    }
}
