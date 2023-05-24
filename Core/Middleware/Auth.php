<?php

namespace Core\Middleware;

use Core\Router;

class Auth
{
    public function handle(): void
    {
        if (! ($_SESSION['user'] ?? false)) {
            Router::abort(403);
        }
    }
}