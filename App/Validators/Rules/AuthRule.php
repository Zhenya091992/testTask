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
        $err = false;
        $result['loginErr'] = (new Validator($request,'login'))
            ->require('fill the field')
            ->check();
        if ($result['loginErr']) {
            $err['loginErr'] = $result['loginErr'];
        }
        $result['passwordErr'] = (new Validator($request,'password'))
            ->require('fill the field')
            ->check();
        if ($result['passwordErr']) {
            $err['passwordErr'] = $result['passwordErr'];
        }

        return $err;
    }
}