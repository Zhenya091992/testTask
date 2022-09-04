<?php

namespace App;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class View
{
    protected $twig;

    public function __construct(string $passToFolderWithTemplate)
    {
        $loader = new FilesystemLoader($passToFolderWithTemplate);
        $this->twig = new Environment($loader);
    }

    public function display(string $template, array $data)
    {
        $template = $this->twig->load($template);
        $template->display($data);
    }
}
