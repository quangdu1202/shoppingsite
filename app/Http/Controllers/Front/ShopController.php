<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\Product\ProductServiceInterface;
use App\Services\ProductCategory\ProductCategoryServiceInterface;
use App\Services\ProductComment\ProductCommentServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    private $productService;
    private $productCommentService;
    private $produdctCategoryService;

    public function __construct(ProductServiceInterface $productService,
                                ProductCommentServiceInterface $productCommentService,
                                ProductCategoryServiceInterface $produdctCategoryService)
    {
        $this->productService = $productService;
        $this->productCommentService = $productCommentService;
        $this->produdctCategoryService = $produdctCategoryService;
    }

    public function show($id)
    {
        $product = $this->productService->find($id);
        $relatedProducts = $this->productService->getRelatedProducts($product);

        return view('front.shop.product', compact('product', 'relatedProducts'));
    }

    public function postComment(Request $request)
    {
        $this->productCommentService->create($request->all());
        return redirect()->back();
    }

    public function index(Request $request)
    {
        $categories = $this->produdctCategoryService->all();

        $products = $this->productService->getProductsOnIndex($request);

        return view('front.shop.index', compact('products', 'categories'));
    }

    public function category($categoryName, Request $request)
    {
        $categories = $this->produdctCategoryService->all();
        $products = $this->productService->getProductsByCategory($categoryName ,$request);
        return view('front.shop.index', compact('products', 'categories'));
    }
}
