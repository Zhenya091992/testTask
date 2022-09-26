<?php

namespace App\Validators\Rules;

use App\Config;
use App\JsonStorage;
use App\Request;
use App\Validators\Rules\RuleInterface;
use App\Validators\Validator;

class AuthRule implements RuleInterface
{

    public function validate(Request $request)
    {
        $err = [];
        $result['loginErr'] = (new Validator($request, 'login'))
            ->require('fill the field')
            ->noSpaces('spaces are not allowed')
            ->check();
        $err['loginErr'] = $result['loginErr'] ?? '';
        $result['passwordErr'] = (new Validator($request, 'password'))
            ->require('fill the field')
            ->noSpaces('spaces are not allowed')
            ->check();
        $err['passwordErr'] = $result['passwordErr'] ?? '';
        if (array_filter($err)) {
            return $err;
        }

        return false;
    }
}
