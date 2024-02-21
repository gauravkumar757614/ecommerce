@php
    $address = json_decode($order->order_address);
    $coupon = json_decode($order->coupon);
    $shippingMethod = json_decode($order->shipping_method);
@endphp

@extends('frontend.dashboard.layouts.master')

@section('title')
    {{ $settings->site_name }} || Order Details
@endsection

@section('content')
    {{-- DASHBOARD START --}}
    <section id="wsus__dashboard">
        <div class="container-fluid">
            {{-- Sidebar --}}
            @include('frontend.dashboard.layouts.sidebar');
            {{-- Sidebar End --}}

            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> Order Detail </h3>

                        <section id="wsus__cart_view" class="invoice-print">
                            <div class="">
                                <div class="wsus__invoice_area">
                                    <div class="wsus__invoice_header">
                                        <div class="wsus__invoice_content">
                                            <div class="row">
                                                <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
                                                    <div class="wsus__invoice_single">
                                                        <address>
                                                            <strong>Billed Information:</strong><br>
                                                            <strong>Name:</strong> {{ $address->name }} <br>
                                                            <strong>Email:</strong>{{ $address->email }}<br>
                                                            <strong>Phone:</strong>{{ $address->phone }}<br>
                                                            <strong>Address:</strong> {{ $address->address }} <br>
                                                            {{ $address->city }} , {{ $address->state }} ,
                                                            {{ $address->zip }}
                                                            {{ $address->country }}
                                                        </address>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
                                                    <div class="wsus__invoice_single text-md-center">
                                                        <address>
                                                            <strong>shipping information</strong><br>
                                                            <strong>Name:</strong> {{ $address->name }} <br>
                                                            <strong>Email:</strong>{{ $address->email }}<br>
                                                            <strong>Phone:</strong>{{ $address->phone }}<br>
                                                            <strong>Address:</strong> {{ $address->address }} <br>
                                                            {{ $address->city }} , {{ $address->state }} ,
                                                            {{ $address->zip }}
                                                            {{ $address->country }}
                                                        </address>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-4">
                                                    <div class="wsus__invoice_single text-md-end">
                                                        <h5>Order Id: #{{ $order->invoice_id }} </h5>
                                                        <h6>Order Status:
                                                            {{ config('order_status.order_status_admin')[$order->order_status]['status'] }}
                                                        </h6>
                                                        <p>Payment Method: {{ $order->payment_method }} </p>
                                                        <p>Payment Status: {{ $order->payment_status }}</p>
                                                        <p>Transaction Id: {{ $order->transaction->transaction_id }} </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="wsus__invoice_description">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tr>

                                                        <th class="amount">
                                                            shop name
                                                        </th>

                                                        <th class="name">
                                                            product
                                                        </th>

                                                        <th class="amount">
                                                            amount
                                                        </th>

                                                        <th class="quentity">
                                                            quentity
                                                        </th>
                                                        <th class="total">
                                                            total
                                                        </th>
                                                    </tr>

                                                    @foreach ($order->orderProducts as $product)
                                                        @php
                                                            $variants = json_decode($product->variants);
                                                        @endphp
                                                        <tr>
                                                            <td class="amount">
                                                                {{ $product->vendor->shop_name }}
                                                            </td>

                                                            <td class="name">
                                                                <p> {{ $product->product_name }} </p>
                                                                @foreach ($variants as $key => $variant)
                                                                    <span>
                                                                        {{ $key }} : {{ $variant->name }}
                                                                        {{ $settings->currency_icon }}
                                                                        {{ $variant->price }}
                                                                    </span>
                                                                @endforeach
                                                            </td>
                                                            <td class="amount">
                                                                {{ $settings->currency_icon }}
                                                                {{ $product->unit_price }}
                                                            </td>

                                                            <td class="quentity">
                                                                {{ $product->qty }}
                                                            </td>
                                                            <td class="total">
                                                                {{ $settings->currency_icon }}
                                                                {{ ($product->unit_price + $product->variant_total) * $product->qty }}
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wsus__invoice_footer">
                                        <p>
                                            <span>Sub Total:</span> {{ $settings->currency_icon }} {{ $order->subtotal }}
                                        </p>
                                        <p>
                                            <span>Shipping Fee (+):</span> {{ $settings->currency_icon }}
                                            {{ $shippingMethod->cost ?? 0 }}
                                        </p>
                                        <p>
                                            <span>Coupon (-):</span>{{ $settings->currency_icon }}
                                            {{ $coupon->discount ?? 0 }}
                                        </p>
                                        <p>
                                            <span>Total amount (-):</span>{{ $settings->currency_icon }}
                                            {{ $order->amount }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <div class="col">
                            <div class="mt-3">
                                <button class="btn btn-warning float-end print_invoice">
                                    Print
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- DASHBOARD START --}}
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.print_invoice').on('click', function() {
                let printBody = $('.invoice-print');
                let originalContent = $('body').html();

                $('body').html(printBody.html());
                window.print();

                $('body').html(originalContent);
            })
        })
    </script>
@endpush
