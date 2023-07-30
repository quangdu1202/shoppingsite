<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\Order\OrderServiceInterface;
use App\Services\OrderDetail\OrderDetailServiceInterface;
use App\Utilities\VNPay;
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

        if($request->payment_type == 'cod') {
            //3. Xoá giỏ hàng
            Cart::destroy();

            //4. Trả về kết quả
            return redirect('checkout/result')->with('notification', 'Order placed! Check your email for more detail!');
        }else{ //Hiện tại đặt là Paypal, cần sửa sau
            //1. Khởi tạo URL VNPay
            $data_url = VNPay::vnpay_create_payment([
                'vnp_TxnRef' => $order->id, //ID đơn hàng
                'vnp_OrderInfo' => 'Mô tả đơn hàng, sửa tuỳ ý //Quang',
                'vnp_Amount' => Cart::total(0, '', '') * 23695, //Tổng thiệt hại đơn hàng, lấy tỉ giá 1USD = 23.695VND
            ]);
            //2. Chuyển hướng tới URL vừa tạo
            return redirect()->to($data_url);
        }
    }

    public function vnPayCheck(Request $request)
    {
        //1. Lấy data từ URL do VNPay gửi về qua $vnp_Returnurl
        $vnp_ResponseCode = $request->get('vnp_ResponseCode'); //Mã phản hồi -> 00 = Thành công
        $vnp_TxnRef = $request->get('vnp_TxnRef'); //order id
        $vnp_Amount = $request->get('vnp_Amount'); //Số tiền thanh toán

        //2. Kiểm tra data, kết quả giao dịch trả về hợp lệ
        if($vnp_ResponseCode != null) {
            if($vnp_ResponseCode == 00) { //Thành công
                //Xoá giỏ hàng
                    Cart::destroy();
                //Trả về kết quả
                return redirect('checkout/result')->with('notification', 'Order placed! Check your email for more detail!');
            }else {
                //Xoá đơn hàng đã thêm vào database
                $this->orderService->delete($vnp_TxnRef);
                //Thông báo lỗi
                return redirect('checkout/result')->with('notification', 'Payment failed or Canceled, please try again!');
            }
        }
    }

    public function result()
    {
        $notification = session('notification');
        return view('front.checkout.result', compact('notification'));
    }
}
