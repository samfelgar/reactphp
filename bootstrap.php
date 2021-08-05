<?php

use FastRoute\DataGenerator;
use FastRoute\DataGenerator\CharCountBased;
use FastRoute\RouteParser;
use FastRoute\RouteParser\Std;
use Samfelgar\Reactphp\Container\Container;
use Samfelgar\Reactphp\Routing\Router;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

require_once __DIR__ . '/vendor/autoload.php';

Container::add(RouteParser::class, Std::class);
Container::add(DataGenerator::class, CharCountBased::class);

Router::registerRoutes();

$exceptionHandler = new Run();

$exceptionHandler->pushHandler(new PrettyPageHandler());

$exceptionHandler->register();