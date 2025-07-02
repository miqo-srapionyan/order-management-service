<?php

declare(strict_types=1);

namespace App\DTO;

use function date;

class Order
{
    public string $orderId;
    public string $productId;
    public int $quantity;
    public float $totalPrice;
    public string $createdAt;

    public function __construct(string $orderId, string $productId, int $quantity, float $totalPrice)
    {
        $this->orderId = $orderId;
        $this->productId = $productId;
        $this->quantity = $quantity;
        $this->totalPrice = $totalPrice;
        $this->createdAt = date('Y-m-d H:i:s');
    }
}
