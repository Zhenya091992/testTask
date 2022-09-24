<?php

namespace App\Controllers;

class CabinetController extends Controller
{
    public function home()
    {
        $this->view->display('cabinet/content.twig', $errors ?? []);
    }
}