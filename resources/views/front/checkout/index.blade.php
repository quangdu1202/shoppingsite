@extends('front.layout.master')

@section('title', 'Checkout')

@section('body')
    <!-- Breadcrumb Section start -->
    <div class="breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="index.html"><i class="fa fa-home"></i> Home</a>
                        <a href="shop.html">Shop</a>
                        <span>Check out</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section end -->

    <!-- Checkout Section begin -->
    <div class="checkout-section spad">
        <div class="container">
            <form action="#" class="checkout-form">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="checkout-content">
                            <a href="login.html" class="content-btn">Click Here To Login</a>
                        </div>
                        <h4>Billing Details</h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="fname">First Name <span>*</span></label>
                                <input type="text" name="" id="fname">
                            </div>
                            <div class="col-lg-6">
                                <label for="lname">Last Name <span>*</span></label>
                                <input type="text" name="" id="lname">
                            </div>
                            <div class="col-lg-12">
                                <label for="cpnname">Company Name</label>
                                <input type="text" name="" id="cpnname">
                            </div>
                            <div class="col-lg-12">
                                <label for="ctr">Country <span>*</span></label>
                                <input type="text" name="" id="ctr">
                            </div>
                            <div class="col-lg-12">
                                <label for="str">Street Address <span>*</span></label>
                                <input type="text" name="" id="str" class="street-first">
                                <input type="text" name="" id="">
                            </div>
                            <div class="col-lg-12">
                                <label for="town">Town / City <span>*</span></label>
                                <input type="text" name="" id="town">
                            </div>
                            <div class="col-lg-6">
                                <label for="email">Email <span>*</span></label>
                                <input type="text" name="" id="email">
                            </div>
                            <div class="col-lg-6">
                                <label for="phone">Phone Number <span>*</span></label>
                                <input type="text" name="" id="phone">
                            </div>
                            <div class="col-lg-12">
                                <div class="create-item">
                                    <label for="acc-create">
                                        Need a new account?
                                        <input type="checkbox" name="" id="acc-create">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="checkout-content">
                            <input type="text" placeholder="Enter your coupon code" name="" id="">
                        </div>
                        <div class="place-order">
                            <h4>Order Details</h4>
                            <div class="order-total">
                                <ul class="order-table">
                                    <li>Product <span>Total</span></li>

                                    @foreach($cartItems as $cartItem)
                                    <li class="fw-normal">
                                        {{$cartItem->name}} x {{$cartItem->qty}}
                                        <span>${{number_format($cartItem->price * $cartItem->qty, 2)}}</span>
                                    </li>
                                    @endforeach

                                    <li class="fw-normal sub-total">Subtotal <span>${{$subtotal}}</span></li>
                                    <li class="total-price">Final Total <span>${{$total}}</span></li>
                                </ul>
                                <div class="payment-check">
                                    <div class="pc-item">
                                        <label for="pc-cod">
                                            Cash On Delivery
                                            <input type="checkbox" name="" id="pc-cod">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="pc-item">
                                        <label for="pc-paypal">
                                            Paypal
                                            <input type="checkbox" name="" id="pc-paypal">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="order-btn">
                                    <button type="submit" class="site-btn place-btn">Place Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Checkout Section end -->
@endsection
