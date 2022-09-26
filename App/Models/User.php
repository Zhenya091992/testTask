<?php

namespace App\Models;

use App\Config;
use App\Model;
use App\StorageInterface;

class User extends Model
{
    protected $table = 'user';

    public function __set($name, $value)
    {
        if ($name === 'password') {
            $value = $this->handlePassword($value);
        }
        parent::__set($name, $value); // TODO: Change the autogenerated stub
    }

    public static function checkPassword($login, $password)
    {
        $storage = $storage ?? Config::instance()->configData['storage'];
        $user = $storage->findWhere('user', ['login' => $login]);
        if (!empty($user[0])) {
            $user = $user[0];
            $password = md5($user->salt . md5($password));
            if ($password === $user->password) {

                return $user;
            }
        }

        return false;
    }

    public function authenticate($remember)
    {
        $_SESSION['userid'] = $this->id;
        if ($remember) {
            $this->token = rand(10000000000000000, 100000000000000000);
            $time = time()+86400 * 30 * 12;
            setcookie('loginUser', $this->login, $time);
            setcookie('tokenUser', $this->token, $time);
            $this->save();
        }
    }

    protected function handlePassword($password)
    {
        $this->salt ?? rand(100000, 10000000);

        return md5($this->salt . md5($password));
    }


}
