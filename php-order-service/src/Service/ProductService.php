<?php

declare(strict_types=1);

namespace App\Service;

use App\HttpClient\ProductClient;

class ProductService
{
    public function __construct(
        private readonly ProductClient $client
    ) {}

    /**
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function listProducts(): array
    {
        return $this->client->getProducts();
    }
}
