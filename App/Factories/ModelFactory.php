<?php

namespace App\Factories;

use App\Model;

abstract class ModelFactory
{
    public static function makeModel($model, array $data)
    {
        $id = array_keys($data)[0];
        $nameModel = 'App\Models\\' . $model;
        $object = new $nameModel();
        $object->setId($id);
        $object->setProperty($data[$id]);

        return $object;
    }
}
