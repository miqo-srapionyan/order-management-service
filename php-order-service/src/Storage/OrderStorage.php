<?php

declare(strict_types=1);

namespace App\Storage;

use App\DTO\Order;

class OrderStorage
{
    /**
     * @var Order[]
     */
    private array $orders = [];

    /**
     * @param Order $order
     *
     * @return void
     */
    public function add(Order $order): void
    {
        $this->orders[] = $order;
    }

    /**
     * @return Order[]
     */
    public function all(): array
    {
        return $this->orders;
    }
}
