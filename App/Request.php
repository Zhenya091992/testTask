<?php

namespace App;

class Request
{
    protected $data;

    public function setData($data)
    {
        $this->data = $data;
    }

    public function setJsonData($json)
    {
        $std = json_decode($json);
        foreach ($std as $property => $value) {
            $this->data[$property] = $value;
        }
    }

    public function getData($name)
    {
        return $this->data[$name] ?? null;
    }
}
