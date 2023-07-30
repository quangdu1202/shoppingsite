<?php

namespace App\Services\Order;

use App\Repositories\Order\OrderDetailRepositoryInterface;
use App\Services\BaseService;

class OrderService extends BaseService implements OrderServiceInterface
{
    public $repository;

    public function __construct(OrderDetailRepositoryInterface $orderRepository)
    {
        $this->repository = $orderRepository;
    }
}
