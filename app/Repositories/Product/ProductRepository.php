<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\BaseRepositories;

class ProductRepository extends BaseRepositories implements ProductRepositoryInterface
{

    public function getModel(): string
    {
        return Product::class;
    }
}
