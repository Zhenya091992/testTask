<?php

return [
    '/Registration' => ['controller' => 'App\Controllers\AccessController', 'action' => 'registration'],
    '/Register' => ['controller' => 'App\Controllers\AccessController', 'action' => 'register'],
    '/Authentication' => ['controller' => 'App\Controllers\AccessController', 'action' => 'authentication'],
    '/Authenticate' => ['controller' => 'App\Controllers\AccessController', 'action' => 'authenticate'],
    '/Cabinet' => ['controller' => 'App\Controllers\CabinetController', 'action' => 'home'],
    '/Exit' => ['controller' => 'App\Controllers\AccessController', 'action' => 'userExit']
];
