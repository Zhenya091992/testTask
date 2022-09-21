<?php

namespace App\Controllers;

use App\Config;
use App\JsonStorage;
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
        if ($errors = $rule->validate($this->request)) {
            echo json_encode($errors);
        }

        $user = new User();
        $user->login = $this->request->getData('login');
        $user->name = $this->request->getData('nameUser');
        $user->email = $this->request->getData('email');
        $user->password = $this->request->getData('password');
        $user->save();

    }

    public function authentication()
    {
        $this->view->display('autorise/content.twig', []);
    }

    public function authenticate()
    {
        var_dump($_POST);
    }
}
