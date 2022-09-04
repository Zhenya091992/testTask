<?php

namespace App\Controllers;

use App\View;

class Controller
{
   public function autorisation()
   {
        $view = new View(__DIR__ . '/../../resource/view');

        $view->display('autorise/content.twig', []);
   }
}