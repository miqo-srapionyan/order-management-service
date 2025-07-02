<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\Order;
use App\HttpClient\ProductClient;
use App\Storage\OrderStorage;
use Exception;
use Ramsey\Uuid\Uuid;

class OrderService
{
    public function __construct(
        private readonly OrderStorage $storage,
        private readonly ProductClient $client
    ) {}

    /**
     * @param string $productId
     * @param int    $quantity
     *
     * @return \App\DTO\Order
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function createOrder(string $productId, int $quantity): Order
    {
        $product = $this->client->getProduct($productId);
        if (!$product) {
            throw new Exception('Product not found');
        }

        if (!isset($product['stock']) || $quantity > $product['stock']) {
            throw new Exception('Requested quantity exceeds available stock');
        }

        $order = new Order(
            Uuid::uuid4()->toString(),
            $productId,
            $quantity,
            $product['price'] * $quantity
        );

        $this->storage->add($order);

        return $order;
    }

    /**
     * @return Order[]
     */
    public function listOrders(): array
    {
        return $this->storage->all();
    }
}
