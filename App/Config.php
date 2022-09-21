<?php

namespace App;

/**
 * Class Config
 *
 * @package App
 */
class Config
{
    /**
     * @var null|self contain object self class
     */
    protected static $instance = null;

    /**
     * @var array contain array config data
     */
    public $configData;

    public $routs;

    /**
     * create singleton Config
     *
     * @return Config
     */
    public static function instance()
    {
        return !static::$instance ? static::$instance = new static() : static::$instance;
    }

    /**
     * Config protected constructor.
     *
     * read config.php file and fill $configData
     */
    protected function __construct()
    {
        $this->configData = include __DIR__ . '/../config/config.php';
        $this->routs = include __DIR__ . '/../config/routs.php';
    }
}