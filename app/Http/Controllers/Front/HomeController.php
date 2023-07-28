<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Product;
use App\Services\Product\ProductServiceInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $productService;
    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    public function index() {

        $featuredProducts = $this->productService->getFeaturedProducts();

        $blogs = Blog::orderBy('created_at', 'desc')->limit(3)->get();
//        dd($menProducts);

        return view('front.index', compact('featuredProducts', 'blogs'));
    }
}
