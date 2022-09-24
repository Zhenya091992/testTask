<?php

namespace App;

use App\Factories\ModelFactory;

class JsonStorage implements StorageInterface
{
    protected $store;

    protected $path;

    protected $table;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function create($table, $model)
    {
        $this->getAll($table);
        $array = [];
        foreach ($model as $property => $value) {
            $array[$property] = $value;
        }
        if (empty($this->store)) {
            $this->store[1] = $array;
        } else {
            $this->store[] = $array;
        }
        $id = array_key_last($this->store);
        $this->save();
        return $id;
    }

    public function read($table, $id): Model
    {
        return ModelFactory::makeModel(ucfirst($table), [$id => $this->findById($table, $id)]);
    }

    public function update($table, $id, $model)
    {
        $this->getAll($table);
        $this->store[$id] = $model;
        $this->save();
    }

    public function delete($table, $id)
    {
        $this->getAll($table);
        unset($this->store[$id]);
        $this->save();
    }

    public function findWhere($table, array $condition)
    {
        $this->getAll($table);
        $matchId = [];
        foreach ($this->store as $id => $model) {
            foreach ($condition as $property => $value) {
                if ($model[$property] === $value) {
                    $matchId[$id] = $id;
                } else {
                    unset ($matchId[$id]);
                    break;
                }
            }
        }
        $objects = [];
        foreach ($matchId as $id) {
            $objects[] = $this->read($table, $id);
        }

        return $objects;
    }

    public function getAll($table)
    {
        if (empty($this->store)) {
            $this->table = $table;
            $this->store = json_decode(file_get_contents($this->path . $table . '.json'), true) ?? [];
        }
    }

    protected function save()
    {
        if (!empty($this->store)) {
            file_put_contents($this->path . $this->table . '.json', json_encode($this->store));
        }
    }

    protected function findById($table, $id)
    {
        $this->getAll($table);

        return  $this->store[$id];
    }
}
