<?php

namespace App\Validators;

use App\JsonStorage;
use App\Request;

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
        if ($storage->findWhere('user', [$this->name => $this->value])) {
            $this->errors[] = $message;
        }

        return $this;
    }

    public function numbsAndLetters($message)
    {
        if (preg_match('/\W/', $this->value)) {
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

    public  function require($message)
    {
        if (empty($this->value)) {
            $this->errors[] = $message;
        }

        return $this;
    }

    public function noSpaces($message)
    {
        if (preg_match('/\s+/', $this->value)) {
            $this->errors[] = $message;
        }

        return $this;
    }
}