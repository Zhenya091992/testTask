<?php

namespace App\Controllers;

use App\Authorization;
use App\Router;
use App\View;
use App\Request;

abstract class Controller
{
    protected $view;

    protected $request;

    protected $router;

    protected $auth;

    public function __construct(Router $router)
    {
        $this->router = $router;
        $this->view = new View(__DIR__ . '/../../resource/view');
        $this->request = new Request();
        $this->auth = Authorization::check();

        if ($this->auth) {
            $this->view->addData(['userName' => $this->auth->user->name,  'userId' => $this->auth->user->getId]);
        }
    }
}
