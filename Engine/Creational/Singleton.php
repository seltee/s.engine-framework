<?php
namespace Engine\Creational;

class Singleton
{
    /**
     * @var Singleton
     */
    private static $instance;
    final public static function getInstance(): Singleton
    {
        if (null === self::$instance) {
            self::$instance = new static();
            self::$instance->build();
        }

        return self::$instance;
    }

    final private function __construct()
    {
    }

    final private function __clone()
    {
    }

    protected function build(){
    }
}