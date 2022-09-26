<?php

namespace App;

class Router
{
    protected $routs;

    public function __construct($routs)
    {
        $this->routs = $routs;
    }

    public function routing(string $requestUri, $data = null)
    {
        foreach ($this->routs as $uri => $setup) {
            if ($uri == $requestUri) {
                $controller = new $setup['controller']($this);
                $controller->{$setup['action']}($data);
            }
        }
    }
}
