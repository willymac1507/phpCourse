<?php

namespace Core;

class App
{
    protected static object $container;

    public static function setContainer($container)
    {
        static::$container = $container;
    }

    public static function container(): object
    {
        return static::$container;
    }

//    public static function bind($key, $factory): void
//    {
//        static::container()->bind($key, $factory);
//    }

    public static function resolve($key)
    {
        return static::container()->resolve($key);
    }
}