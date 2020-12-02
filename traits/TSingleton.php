<?php

namespace app\traits;

/**
 * Trait TSingleton
 * @package app\traits
 */
trait TSingleton
{
    protected static $instance = null;

    private function __construct() { }

    private function __clone() { }

    /**
     * @return static
     */
    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static();
        }
        return static::$instance;
    }
}
