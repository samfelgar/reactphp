<?php

namespace Samfelgar\Reactphp\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HomeController extends Controller
{
    public function index(Request $request): Response
    {
        $data = [
            'message' => 'Everything working!',
            'date' => (new \DateTime())->format('Y-m-d H:i:s'),
        ];

        return $this->response(json_encode($data), [
            'content-type' => 'application/json'
        ]);
    }
}
