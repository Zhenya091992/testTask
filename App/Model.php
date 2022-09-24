<?php

namespace App;

use App\Config;

abstract class Model implements \Iterator, \ArrayAccess
{
    protected $id;

    protected StorageInterface $storage;

    protected $table;

    protected $data = [];

    public function __construct(?StorageInterface $storage = null)
    {
        $this->storage = $storage ?? Config::instance()->configData['storage'];
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function save()
    {
        if (!empty($this->id)) {
            $this->storage->update($this->table, $this->id, $this->data);
        } else {
            if ($id = $this->storage->create($this->table, $this)) {
                $this->id = $id;
            }
        }
    }

    public function delete()
    {
        $this->storage->delete($this->table, $this->id);
    }

    public function getTable()
    {
        if (empty($this->table)) {
            throw new \Exception('table no defined for the ' . static::class);
        }

        return $this->table;
    }

    public function __get($name)
    {
        return $this->data[$name];
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __isset($name)
    {
        return isset($this->data[$name]);
    }

    public function __unset($name)
    {
        unset($this->data[$name]);
    }

    public function key()
    {
        return key($this->data);

    }

    public function next()
    {
        next($this->data);
    }

    public function rewind()
    {
        reset($this->data);
    }

    public function valid()
    {
        return null !== key($this->data);
    }

    public function current()
    {
        return current($this->data);

    }

    public function offsetExists($offset) :bool
    {
        return isset($this->data[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->data[$offset] ?? null;
    }

    public function offsetSet($offset, $value)
    {
        is_null($offset) ? $this->data[] = $value : $this->data[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }
}