<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\ProductService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use function json_encode;

class ProductController
{
    public function __construct(private readonly ProductService $service)
    {
    }

    /**
     * Get orders list.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface      $response
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function list(Request $request, Response $response): Response
    {
        $orders = $this->service->listProducts();
        $response->getBody()->write(json_encode($orders));

        return $response->withHeader('Content-Type', 'application/json');
    }
}
