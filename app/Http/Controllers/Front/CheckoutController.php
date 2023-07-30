<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::content();
        $subtotal = Cart::subtotal();
        $total = Cart::total();

        return view('front.checkout.index', compact('cartItems', 'subtotal', 'total'));
    }
}
