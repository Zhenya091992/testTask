<?php

namespace App;

class Router
{
    protected $routs;

    public function __construct($routs)
    {
        $this->routs = $routs;
    }

    public function routing(string $requestUri)
    {
        foreach ($this->routs as $uri => $setup) {
            if ($uri == $requestUri) {
                $controller = new $setup['controller'];
                $controller->{$setup['action']}();
            }
        }
    }
}
