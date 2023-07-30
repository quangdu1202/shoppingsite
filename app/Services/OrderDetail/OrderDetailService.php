<?php

namespace App\Services\OrderDetail;

use App\Repositories\Order\OrderDetailRepositoryInterface;
use App\Services\BaseService;

class OrderDetailService extends BaseService implements OrderDetailServiceInterface
{
    public $repository;

    public function __construct(OrderDetailRepositoryInterface $orderDetailRepository)
    {
        $this->repository = $orderDetailRepository;
    }
}
