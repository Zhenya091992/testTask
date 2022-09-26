<?php

namespace App;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class View
{
    protected $twig;

    protected $data = [];

    public function __construct(string $passToFolderWithTemplate)
    {
        $loader = new FilesystemLoader($passToFolderWithTemplate);
        $this->twig = new Environment($loader);
    }

    public function display(string $template, array $data = [])
    {
        $template = $this->twig->load($template);
        $template->display(array_merge($data, $this->data));
    }

    public function addData(array $array)
    {
        $this->data = $array;
    }
}
