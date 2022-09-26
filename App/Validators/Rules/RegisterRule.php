<?php

namespace App\Validators\Rules;

use App\Config;
use App\JsonStorage;
use App\Request;
use App\Validators\Rules\RuleInterface;
use App\Validators\Validator;

class RegisterRule implements RuleInterface
{

    public function validate(Request $request)
    {
        $err = false;
        $result['loginErr'] = (new Validator($request,'login'))
            ->minLength(6, 'min length must be 6 symbols')
            ->unique(Config::instance()->configData['storage'], 'login must be unique')
            ->noSpaces('spaces are not allowed')
            ->check();
        $err['loginErr'] = $result['loginErr'] ?? '';

        $result['passwordErr'] = (new Validator($request,'password'))
            ->minLength(6, 'min length must be 6 symbols')
            ->numbsAndLetters('password must contain the letters and numbers')
            ->noSpaces('spaces are not allowed')
            ->check();
        $err['passwordErr'] = $result['passwordErr'] ?? '';

        $result['confirmPasswordErr'] = (new Validator($request,'confirmPassword'))
            ->mustMatch($request->getData('password'), 'password confirm dont match with password')
            ->noSpaces('spaces are not allowed')
            ->check();
        $err['confirmPasswordErr'] = $result['confirmPasswordErr'] ?? '';

        $result['emailErr'] = (new Validator($request,'email'))
            ->unique(Config::instance()->configData['storage'], 'email must be unique')
            ->email('wrong email')
            ->noSpaces('spaces are not allowed')
            ->check();
        $err['emailErr'] = $result['emailErr'] ?? '';

        $result['nameErr'] = (new Validator($request,'name'))
            ->minLength(2, 'min length must be 2 symbols')
            ->onlyLetters('must contain only letters')
            ->check();
        $err['nameErr'] = $result['nameErr'] ?? '';

        if (array_filter($err)) {
            return $err;
        }

        return false;
    }
}
