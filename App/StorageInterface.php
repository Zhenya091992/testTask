<?php

namespace App;

interface StorageInterface
{
    public function create($table, $model);

    public function read($table, $id);

    public function update($table, $id, $model);

    public function delete($table, $id);
}
