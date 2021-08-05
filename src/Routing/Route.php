<?php

namespace Samfelgar\Reactphp\Routing;

class Route
{
    private static array $routes = [];

    public static function add(string $method, string $path, callable $action): void
    {
        static::$routes[] = [
            'method' => $method,
            'path' => $path,
            'action' => $action,
        ];
    }

    public static function get(string $path, callable $action): void
    {
        static::add('GET', $path, $action);
    }

    public static function post(string $path, callable $action): void
    {
        static::add('POST', $path, $action);
    }

    public static function put(string $path, callable $action): void
    {
        static::add('PUT', $path, $action);
    }

    public static function delete(string $path, callable $action): void
    {
        static::add('DELETE', $path, $action);
    }

    public static function patch(string $path, callable $action): void
    {
        static::add('PATCH', $path, $action);
    }

    public static function routes(): array
    {
        return static::$routes;
    }
}