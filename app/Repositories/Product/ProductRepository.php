<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{

    public function getModel()
    {
        return Product::class;
    }

    public function getRelatedProducts($product)
    {
        $relatedProducts = $this->model->where('product_category_id', $product->product_category_id)
                    ->where('tag', $product->tag)
                    ->limit(4)
                    ->get();

        return $relatedProducts->filter(function ($relatedProduct) use ($product) {
            return $relatedProduct->id !== $product->id;
        });
    }

    public function getFeaturedProductsByCategory(int $category)
    {
        return $this->model->where('featured', true)
            ->where('product_category_id', $category)
            ->get();
    }

    public function getProductsOnIndex($request)
    {
        $search = $request->search ?? '';
        $products = $this->model->where('name', 'like', '%'.$search.'%');

        return $this->sortAndPagination($products, $request);
    }

    public function getProductsByCategory($categoryName, $request)
    {
        $products = ProductCategory::where('name', $categoryName)->first()->products->toQuery();

        return $this->sortAndPagination($products, $request);
    }

    private function sortAndPagination($products, Request $request)
    {
        $productsPerPage = $request->show ?? 9;
        $sort = $request->sort ?? 'newest';
        switch ($sort) {
            case 'newest':
                $products = $products->orderBy('id');
                break;
            case 'oldest':
                $products = $products->orderByDesc('id');
                break;
            case 'price-ascending':
                $products = $products->orderBy('price');
                break;
            case 'price-descending':
                $products = $products->orderByDesc('price');
                break;
            case 'name-ascending':
                $products = $products->orderBy('name');
                break;
            case 'name-descending':
                $products = $products->orderByDesc('name');
                break;
            default:
                $products = $products->orderBy('id');
        }
        return $products->paginate($productsPerPage)->appends(['sort' => $sort, 'show' => $productsPerPage]);
    }
}
