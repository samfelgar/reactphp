<?php

namespace Samfelgar\Reactphp\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface as Response;
use Samfelgar\Reactphp\Container\Container;

class Controller
{
    protected function response(string $string, array $headers = [], int $code = 200): Response
    {
        $psrFactory = Container::get(Psr17Factory::class);

        $response = $psrFactory->createResponse($code);

        $response->getBody()->write($string);

        foreach ($headers as $name => $value) {
            $response->withHeader($name, $value);
        }

        return $response;
    }
}
