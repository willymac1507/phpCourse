<?php

namespace Core;

use Exception;
use JetBrains\PhpStorm\NoReturn;

class Container
{

    protected array $bindings = [];

public function bind($key, $factory): void
    {
        $this->bindings[$key] = $factory;
    }

    /**
     * @throws Exception
     */
    public function resolve($key)
    {
        if (!array_key_exists($key, $this->bindings)) {
            throw new Exception("No matching binding found for {$key}");
        }
        $factory = $this->bindings[$key];
        return call_user_func($factory);
    }
}