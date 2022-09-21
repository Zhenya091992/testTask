<?php

namespace App\Validators\Rules;

use App\Request;
use App\Validators\Rules\RuleInterface;
use App\Validators\Validator;

class RegisterRule implements RuleInterface
{

    public function validate(Request $request)
    {
        $result = (new Validator($request,'login'))
            ->minLength(6, 'min length must be 6 symbols')
            ->check();

        return $result;
    }
}
