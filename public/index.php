<?php

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;
use Samfelgar\Reactphp\Container\Container;
use Samfelgar\Reactphp\Routing\Router;

require_once __DIR__ . '/../bootstrap.php';

/**
 * Emitting the response
 */
$psrFactory = Container::get(Psr17Factory::class);

$requestCreator = new ServerRequestCreator($psrFactory, $psrFactory, $psrFactory, $psrFactory);

Router::instance()->setJsonStrategy($psrFactory);

$response = Router::instance()->dispatch($requestCreator->fromGlobals());

Router::instance()->emit($response);