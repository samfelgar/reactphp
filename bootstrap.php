<?php

use League\Route\Router as LeagueRouter;
use Psr\Http\Message\ResponseInterface;
use Samfelgar\Reactphp\Container\Container;
use Samfelgar\Reactphp\Routing\Router;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

require_once __DIR__ . '/vendor/autoload.php';

Container::add(LeagueRouter::class)
    ->addArgument(null)
    ->setShared();

Router::registerRoutes();

$exceptionHandler = new Run();

$exceptionHandler->pushHandler(new PrettyPageHandler());

$exceptionHandler->register();