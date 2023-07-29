<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\Product\ProductServiceInterface;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    private $productService;
    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $cartItems = Cart::content();
        $total = Cart::total();
        $subtotal = Cart::subtotal();

        return view('front.shop.cart', compact('cartItems', 'total', 'subtotal'));
    }

    public function add(Request $request)
    {
        if($request->ajax()) {
            $product = $this->productService->find($request->productId);

            $response['cartItem'] = Cart::add([
                'id' => $product->id,
                'name' => $product->name,
                'qty' => 1,
                'price' => $product->discount ?? $product->price,
                'weight' => $product->weight ?? 0,
                'options' => [
                    'images' => $product->productImages,
                ],
            ]);

//        dd(Cart::content());
            $response['count']  = Cart::count();
            $response['total'] = Cart::total();

            return $response;
        }
        return back();
    }
}
