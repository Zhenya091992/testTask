<?php

namespace App\Controllers;

use App\Authorization;

class CabinetController extends Controller
{
    public function home()
    {
        if ($this->auth) {
            $this->view->display('cabinet/content.twig');
            return;
        }

        $this->view->display('authentication/content.twig');
    }
}