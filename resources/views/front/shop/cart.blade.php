@extends('front.layout.master')

@section('title', 'Cart')

@section('body')
    <!-- Breadcrumb Section start -->
    <div class="breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="index.html"><i class="fa fa-home"></i> Home</a>
                        <a href="shop.html">Shop</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section end -->

    <!-- Shopping Cart Section begin -->
    <div class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cart-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th class="p-name">Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>REMOVE</i></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($cartItems as $cartItem)
                                <tr>
                                    <td class="cart-pic first-row"><img style="height: 170px; margin: auto" src="front/img/products/{{$cartItem->options->images[0]->path}}" alt=""></td>
                                    <td class="cart-title first-row">
                                        <h5>{{$cartItem->name}}</h5>
                                    </td>
                                    <td class="p-price first-row">${{number_format($cartItem->price, 2)}}</td>
                                    <td class="qua-col first-row">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="{{$cartItem->qty}}" name="" id="">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="total-price first-row">${{number_format($cartItem->price * $cartItem->qty, 2)}}</td>
                                    <td class="close-td first-row"><i class="ti-close"></i></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="cart-buttons">
                                <a href="/shop" class="primary-btn continue-shop">Continue Shopping</a>
                                <a href="" class="primary-btn up-cart">Update Cart</a>
                            </div>
                            <div class="discount-coupon">
                                <h6>Discount Code</h6>
                                <form action="#" class="coupon-form">
                                    <input type="text" placeholder="Enter your code" name="" id="">
                                    <button type="submit" class="site-btn coupon-btn">Apply</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-4 offset-lg-4">
                            <div class="discount-coupon">
                                <h6>Discount Code</h6>
                                <form action="#" class="coupon-form">
                                    <input type="text" placeholder="Enter your code" name="" id="">
                                    <button type="submit" class="site-btn coupon-btn">Apply</button>
                                </form>
                            </div>
                            <div class="proceed-checkout">
                                <ul>
                                    <li class="subtotal">Subtotal <span>${{$subtotal}}</span></li>
                                    <li class="cart-total">Total <span>${{$total}}</span></li>
                                </ul>
                                <a href="check-out.html" class="proceed-btn">CHECKOUT</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shopping Cart Section end -->
@endsection
