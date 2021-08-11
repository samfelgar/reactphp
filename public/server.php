<?php

use Nyholm\Psr7\Factory\Psr17Factory;
use React\Http\HttpServer;
use React\Socket\SocketServer;
use Samfelgar\Reactphp\Container\Container;
use Samfelgar\Reactphp\Routing\Router;

require_once __DIR__ . '/../bootstrap.php';

$http = new HttpServer(function (\Psr\Http\Message\ServerRequestInterface $request) {
    $psrFactory = Container::get(Psr17Factory::class);

    Router::instance()->setJsonStrategy($psrFactory);

    return Router::instance()->dispatch($request);
});

$socket = new SocketServer('127.0.0.1:8080');

$http->listen($socket);