@php
    $address = json_decode($order->order_address);
@endphp

@extends('vendor.layouts.master')
@section('title')
    {{ $settings->site_name }} || Order Details
@endsection

@section('content')
    {{-- DASHBOARD START --}}
    <section id="wsus__dashboard">
        <div class="container-fluid">
            {{-- Sidebar --}}
            @include('vendor.layouts.sidebar')
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
                                                        @if ($product->vendor_id == Auth::user()->vendor->id)
                                                            @php
                                                                $variants = json_decode($product->variants);
                                                                $total = 0;
                                                                $total += ($product->unit_price + $product->variant_total) * $product->qty;
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
                                                        @endif
                                                    @endforeach

                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wsus__invoice_footer">
                                        <p><span>Total Amount:</span> {{ $settings->currency_icon }} {{ $total }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <div class="row">

                            <div class="col-md-4">
                                <form action="{{ route('vendor.orders.status', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group mt-5">
                                        <label for="" class="form-lable mb-2">Order Statuus</label>
                                        <select name="status" id="" class="form-control">
                                            @foreach (config('order_status.order_status_vendor') as $key => $status)
                                                <option {{ $key == $order->order_status ? 'selected' : '' }}
                                                    value="{{ $key }}"> {{ $status['status'] }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button class="btn btn-primary mt-3" type="submit">Save</button>
                                </form>
                            </div>
                            <div class="col-md-8">
                                <div class="mt-5">
                                    <button class="btn btn-warning float-end print_invoice">
                                        Print
                                    </button>
                                </div>
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
