<?php

namespace Samfelgar\Reactphp\Container;

use League\Container\Container as BaseContainer;
use League\Container\ReflectionContainer;
use Psr\Container\ContainerInterface;

class Container
{
    private static BaseContainer $container;

    public static function instance(): ContainerInterface
    {
        if (isset(static::$container)) {
            return static::$container;
        }

        static::$container = new BaseContainer();

        static::$container->delegate(new ReflectionContainer());

        return static::$container;
    }

    public static function __callStatic($name, $arguments)
    {
        return static::instance()->{$name}(...$arguments);
    }
}