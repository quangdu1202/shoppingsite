<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\Order\OrderServiceInterface;
use App\Services\OrderDetail\OrderDetailServiceInterface;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    private $orderService;
    private $orderDetailService;
    public function __construct(OrderServiceInterface $orderService, OrderDetailServiceInterface  $orderDetailService)
    {
        $this->orderService = $orderService;
        $this->orderDetailService =$orderDetailService;
    }

    public function index()
    {
        $cartItems = Cart::content();
        $subtotal = Cart::subtotal();
        $total = Cart::total();

        return view('front.checkout.index', compact('cartItems', 'subtotal', 'total'));
    }

    public function createOrder(Request $request)
    {
        //1. Khởi tạo đơn hàng
        $order = $this->orderService->create($request->all());
        //2. Thêm thông tin đơn hàng
        $cartItems = Cart::content();

        foreach ($cartItems as $cartItem) {
            $data = [
                'order_id' => $order->id,
                'product_id' => $cartItem->id,
                'qty' => $cartItem->qty,
                'amount' => $cartItem->price,
                'total' => $cartItem->qty * $cartItem->price,
            ];

            $this->orderDetailService->create($data);
        }

        //3. Xoá giỏ hàng
        Cart::destroy();

        //4. Trả về kết quả
        return redirect('checkout/result')->with('notification', 'Order placed! Check your email for more detail!');
    }

    public function result()
    {
        $notification = session('notification');
        return view('front.checkout.result', compact('notification'));
    }
}
