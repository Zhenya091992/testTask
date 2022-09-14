<?php

namespace App\Controllers;

use App\View;

class AccessController extends Controller
{
    public function registration()
    {
        $this->view->display('registration/content.twig', []);
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
