<?php

namespace App\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

final class ProductController
{
    public function getProducts(Request $request, Response $response, $args): Response
    {
        $data = [
            'name' => 'Xavier',
            'idade' => '19'
        ];
        $json = json_encode($data);

        $response->getBody()->write($json);

        return $response;
    }
}
