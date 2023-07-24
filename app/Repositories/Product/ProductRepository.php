<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{

    public function getModel(): string
    {
        return Product::class;
    }

    public function getRelatedProducts($product)
    {
        $relatedProducts = $this->where('product_category_id', $product->product_category_id)
                    ->where('tag', $product->tag)
                    ->limit(4)
                    ->get();

        return $relatedProducts->filter(function ($relatedProduct) use ($product) {
            return $relatedProduct->id !== $product->id;
        });
    }
}
