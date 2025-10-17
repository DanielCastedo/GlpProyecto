<?php

namespace Core;

class Router
{
    private array $routes = [];
    public function get(string $path, callable $handler)
    {
        $this->routes['GET'][$path] = $handler;
    }
    public function post(string $path, callable $handler)
    {
        $this->routes['POST'][$path] = $handler;
    }
    public function dispatch()
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        // Toma PATH_INFO si existe (Apache/Nginx), si no usa REQUEST_URI
        $rawPath = $_SERVER['PATH_INFO'] ?? parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
        $rawPath = urldecode($rawPath);

        // Quita el base_url al comienzo del path
        $cfg = require __DIR__ . '/../config/config.php';
        $base = rtrim($cfg['app']['base_url'] ?? '', '/');           // /glpnuevo/public
        $path = $rawPath;

        if ($base && str_starts_with($path, $base)) {
            $path = substr($path, strlen($base));                    // recorta /glpnuevo/public
        }

        $path = rtrim($path, '/') ?: '/';                            // normaliza

        $handler = $this->routes[$method][$path] ?? null;
        if (!$handler) {
            http_response_code(404);
            echo "<h1>404</h1><p>Route not found: {$method} {$path}</p>";
            return;
        }
        echo call_user_func($handler);
    }
}
