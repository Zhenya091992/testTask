<?php

namespace App\Factories;

use App\Model;

abstract class ModelFactory
{
    public static function makeModel($model, array $data)
    {
        $nameModel = 'App\Models\\' . $model;
        $object = new $nameModel();
        foreach ($data as $property => $value) {
            $object->$property = $value;
        }

        return $object;
    }
}