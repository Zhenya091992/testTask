<?php

namespace App\Controllers;

use App\Router;
use App\View;
use App\Request;

abstract class Controller
{
    protected $view;

    protected $request;

    protected $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
        $this->view = new View(__DIR__ . '/../../resource/view');
        $this->request = new Request();
    }
}
