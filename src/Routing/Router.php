<?php

namespace Samfelgar\Reactphp\Routing;

use Laminas\HttpHandlerRunner\Emitter\EmitterInterface;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use League\Route\Router as BaseRouter;
use League\Route\Strategy\JsonStrategy;
use League\Route\Strategy\StrategyInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Samfelgar\Reactphp\Container\Container;

class Router
{
    private static Router $router;

    protected BaseRouter $baseRouter;
    protected EmitterInterface $emitter;

    public function __construct(BaseRouter $baseRouter, EmitterInterface $emitter)
    {
        $this->baseRouter = $baseRouter;
        $this->emitter = $emitter;
    }

    public static function instance(): Router
    {
        if (isset(static::$router)) {
            return static::$router;
        }

        $baseRouter = Container::get(BaseRouter::class);
        $emitter = Container::get(SapiEmitter::class);

        static::$router = new static($baseRouter, $emitter);

        return static::$router;
    }

    public static function registerRoutes(): void
    {
        $routes = require_once __DIR__ . '/../../routes.php';

        $router = static::instance();

        foreach ($routes as $route) {
            $router->map($route['method'], $route['path'], $route['action']);
        }
    }

    public function setStrategy(StrategyInterface $strategy): Router
    {
        $this->baseRouter->setStrategy($strategy);

        return $this;
    }

    public function setJsonStrategy(ResponseFactoryInterface $responseFactory): Router
    {
        $strategy = new JsonStrategy($responseFactory);

        $this->baseRouter->setStrategy($strategy);

        return $this;
    }

    public function dispatch(Request $request): Response
    {
        return $this->baseRouter->dispatch($request);
    }

    public function emit(Response $response): bool
    {
        return $this->emitter->emit($response);
    }

    public function __call($name, $arguments)
    {
        if (method_exists($this, $name)) {
            return $this->{$name}(...$arguments);
        }

        return $this->baseRouter->{$name}(...$arguments);
    }

    public static function __callStatic($name, $arguments)
    {
        return static::instance()->{$name}(...$arguments);
    }
}
