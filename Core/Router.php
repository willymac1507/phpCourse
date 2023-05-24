<?php

namespace Core;

use Core\Middleware\Middleware;
use JetBrains\PhpStorm\NoReturn;

class Router
{
    protected array $routes = [];

    #[NoReturn] public static function abort($code = 404): void
    {
        http_response_code($code);
        require base_path('controllers/' . $code . '.php');
        die();
    }

    public function get($uri, $controller): static
    {
        return $this->add('GET', $uri, $controller);
    }

    public function add($method, $uri, $controller): static
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null
        ];

        return $this;
    }

    public function post($uri, $controller): static
    {
        return $this->add('POST', $uri, $controller);
    }

    public function delete($uri, $controller): static
    {
        return $this->add('DELETE', $uri, $controller);
    }

    public function patch($uri, $controller): static
    {
        return $this->add('PATCH', $uri, $controller);
    }

    public function put($uri, $controller): static
    {
        return $this->add('PUT', $uri, $controller);
    }

    public function only($key): static
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;
        return $this;
    }

    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                Middleware::resolve($route['middleware']);
                return require base_path($route['controller']);
            }
        }
        abort();
    }
}
