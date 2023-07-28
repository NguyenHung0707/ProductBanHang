
@extends('front.layout.master')

@section('title', 'My Order')
@section('content')

    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="./home.html"><i class="fa fa-home"></i> Home</a>
                        <span>My Order</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->



    <!--Shopping Cart Section Begin-->
    <div class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cart-table">
                        <table>
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>ID</th>
                                <th class="p-name">Product Name</th>
                                <th>Total</th>
                                <th>Details</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($orders as $order)
                                <tr>
                                    <td  class="cart-pic first-row"><img style="height: 170px" src="front/img/products/{{ $order->orderDetails[0]->product->productImages[0]->path }}" alt=""></td>
                                    <td class="first-row">{{ $order->id }}</td>
                                    <td class="cart-title first-row">
                                        <h5>
                                            {{ $order->orderDetails[0]->product->name }}
                                            @if(count($order->orderDetails ) >1)
                                                (and {{ count($order->orderDetails )}}  orther products)
                                            @endif
                                        </h5>
                                    </td>
                                    <td class="total-price first-row">
                                        ${{ array_sum(array_column($order->orderDetails->toArray(), 'total')) }}
                                    </td>
                                    <td class="first-row">
                                        <a href="account/my-order/{{ $order->id }}" class="btn">Details</a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--Shopping Cart Section End-->





@endsection

