<?php

namespace App\Validators;

use App\Request;
use App\Validators\Rules\RuleIntarface;

class Validator
{
    protected $name;

    protected $value;

    protected $errors;

    public function __construct(Request $request, $name)
    {
        $this->name = $name;
        $this->value = $request->getData($name);
    }

    public function check()
    {
        return $this->errors ?? false;
    }

    public function minLength(int $length, string $message)
    {
        if (strlen($this->value) < $length) {
            $this->errors[$this->name][] = $message;
        }

        return $this;
    }
}