@extends('front.layout.master')

@section('title', 'Order Detail')

@section('content')


    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="./home.html"><i class="fa fa-home"></i> Home</a>

                        <span>Order Details</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->


    <!--    Shopping Cart Section Begin-->
    <div class="checkout-section spad">
        <div class="container">
            <form action="" method="get" class="checkout-form">

                <div class="row">

                        <div class="col-lg-6">
                            <div class="checkout-content">
                                <a href="#" class="content-btn">
                                    Order ID:
                                    <b>#{{ $order->id }}</b>
                                </a>
                            </div>
                            <h4>Billing Details</h4>
                            <div class="row">
                                <input type="hidden" id="user_id" name="user_id" value="{{ $order->first_name }}" disabled>

                                <div class="col-lg-6">
                                    <label for="fir">First Name<span>*</span></label>
                                    <input type="text" id="fir" name="first_name" value="{{ $order->first_name }}" disabled>
                                </div>
                                <div class="col-lg-6">
                                    <label for="last">Last Name<span>*</span></label>
                                    <input type="text" id="last" name="last_name" value="{{ $order->last_name }}" disabled>
                                </div>
                                <div class="col-lg-12">
                                    <label for="cun-name">Company Name<span>*</span></label>
                                    <input type="text" id="cun-name" name="company_name" value="{{ $order->company_name }}" disabled>
                                </div>
                                <div class="col-lg-12">
                                    <label for="cun">Country<span>*</span></label>
                                    <input type="text" id="cun" name="country" value="{{ $order->country }}" disabled>
                                </div>
                                <div class="col-lg-12">
                                    <label for="street">Street Address<span>*</span></label>
                                    <input type="text" id="street" class="street-first" name="street_address" value="{{ $order->street_address }}" disabled>
                                </div>
                                <div class="col-lg-12">
                                    <label for="zip">Postcode / ZIP (optional)</label>
                                    <input type="text" id="zip" name="postcode_zip" value="{{ $order->postcode_zip }}" disabled>
                                </div>
                                <div class="col-lg-12">
                                    <label for="town">Town / City<span>*</span></label>
                                    <input type="text" id="town" name="town_city" value="{{ $order->town_city }}" disabled>
                                </div>
                                <div class="col-lg-6">
                                    <label for="email">Email Address<span>*</span></label>
                                    <input type="text" id="email" name="email" value="{{ $order->email }}" disabled>
                                </div>
                                <div class="col-lg-6">
                                    <label for="phone">Phone<span>*</span></label>
                                    <input type="text" id="phone" name="phone" value="{{ $order->phone }}" disabled>
                                </div>




                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="checkout-content">
                                <a href="#" class="content-btn">
                                    Status:
                                    <b>{{ \App\Utilities\Constant::$order_status[$order->status] }}</b>
                                </a>
                            </div>
                            <div class="place-order">
                                <h4>Your Order</h4>
                                <div class="order-total">
                                    <ul class="order-table">
                                        <li>Product <span>Total</span></li>
                                        @foreach($order->orderDetails as $orderDetail)
                                            <li class="fw-normal">{{ $orderDetail->product->name }} x {{ $orderDetail->qty }}
                                                <span>${{ $orderDetail->total }}</span>
                                            </li>
                                        @endforeach
                                        <li class="total-price">Total <span>${{ array_sum(array_column($order->orderDetails->toArray(), 'total')) }}</span></li>
                                    </ul>
                                    <div class="payment-check">
                                        <div class="pc-item">
                                            <label for="pc-check">
                                                Pay later
                                                <input type="radio" id = pc-check name="payment_type" value="pay_later" disabled
                                                    {{ $order->payment_type == 'pay_later' ? 'checked' : '' }}>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="pc-item">
                                            <label>
                                                Online payment
                                                <input type="radio" id = pc-paypal name="payment_type" value="online_payment" disabled
                                                    {{ $order->payment_type == 'online_payment' ? 'checked' : '' }}>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                </div>
            </form>
        </div>
    </div>
    <!--    Shopping Cart Section End-->


@endsection


