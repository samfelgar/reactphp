<?php

namespace Samfelgar\Reactphp\Controller;

use Psr\Http\Message\ResponseInterface as Response;

class Controller
{
    protected Response $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    protected function response(string $string, array $headers = [], int $code = 200): Response
    {
        $this->response->withStatus($code);

        $this->response->getBody()->write($string);

        foreach ($headers as $name => $value) {
            $this->response->withHeader($name, $value);
        }

        return $this->response;
    }
}
