<?php

namespace App\Validators;

use App\JsonStorage;
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
            $this->errors[] = $message;
        }

        return $this;
    }

    public function unique(JsonStorage $storage, string $message)
    {
        if ($storage->findWere('user', [$this->name => $this->value])) {
            $this->errors[] = $message;
        }

        return $this;
    }

    public function numbsAndLetters($message)
    {
        if (preg_match('@^\d\d*\pL+[\d\pL]*|\pL\pL*\d+[\d\pL]*$@SDs', $this->value)) {
            $this->errors[] = $message;
        }

        return $this;
    }

    public function mustMatch($value, $message)
    {
        if ($value !== $this->value) {
            $this->errors[] = $message;
        }

        return $this;
    }

    public function email($message)
    {
        if (!filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = $message;
        }

        return $this;
    }

    public function onlyLetters($message)
    {
        if (!ctype_alpha($this->value)) {
            $this->errors[] = $message;
        }

        return $this;
    }
}