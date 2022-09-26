<?php

namespace App;

class Authorization
{
    public $user;

    protected static $instance = null;

    public static function instance()
    {
        return !static::$instance ? static::$instance = new static() : static::$instance;
    }

    public static function check()
    {
        static::instance();


        if (!empty(static::$instance->user)) {
            return static::$instance;
        }

        if (static::$instance->checkSession()) {
            return static::$instance;
        }

        if (static::$instance->checkCookie()) {
            return static::$instance;
        }

        return false;
    }

    public function unlog()
    {
        unset($_SESSION['userid'], $this->user);
        setcookie('loginUser', '');
        setcookie('tokenUser', '');
        self::$instance = null;
    }

    protected function __construct()
    {
    }

    protected function checkSession()
    {
        if (empty($_SESSION['userid'])) {
            return false;
        }
        $user = Config::instance()
            ->configData['storage']
            ->read('user', $_SESSION['userid']);

        if ($user) {
            $this->user = $user;

            return true;
        }

        return false;
    }

    protected function checkCookie()
    {
        if (!empty($_COOKIE['loginUser']) && !empty($_COOKIE['tokenUser'])) {
            if ($this->getUser($_COOKIE['loginUser'], $_COOKIE['tokenUser'])) {

                return true;
            }
        }

        return false;
    }


    protected function getUser($login, $token)
    {
        $user = Config::instance()
            ->configData['storage']
            ->findWhere('user', ['login' => $login, 'token' => $token]);
        if ($user) {
            $this->user = $user[0];

            return true;
        }

        return false;
    }

}
