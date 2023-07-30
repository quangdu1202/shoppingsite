<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\Order\OrderServiceInterface;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    private $orderService;
    private $orderDetailService;
    public function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
//        $this->orderDetailService =
    }

    public function index()
    {
        $cartItems = Cart::content();
        $subtotal = Cart::subtotal();
        $total = Cart::total();

        return view('front.checkout.index', compact('cartItems', 'subtotal', 'total'));
    }

    public function createOrder()
    {
        //1. Khởi tạo đơn hàng

        //2. Thêm thông tin đơn hàng

        //3. Xoá giỏ hàng

        //4. Trả về kết quả
    }
}
