<?php

namespace Samfelgar\Reactphp\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HomeController extends Controller
{
    public function index(Request $request): Response
    {
        return $this->response('Hello World');
    }
}
