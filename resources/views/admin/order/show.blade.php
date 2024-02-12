@php
    $address = json_decode($order->order_address);
    $shipping = json_decode($order->shipping_method);
    $coupon = json_decode($order->coupon);
@endphp

@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Orders </h1>
        </div>



        <div class="section-body">
            <div class="invoice">
                <div class="invoice-print">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="invoice-title">
                                {{-- <h2>Invoice</h2> --}}
                                <div class="invoice-number">Order #{{ $order->invoice_id }}</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Billed To:</strong><br>
                                        <strong>Name:</strong> {{ $address->name }} <br>
                                        <strong>Email:</strong>{{ $address->email }}<br>
                                        <strong>Phone:</strong>{{ $address->phone }}<br>
                                        <strong>Address:</strong> {{ $address->address }} <br>
                                        {{ $address->city }} , {{ $address->state }} , {{ $address->zip }}
                                        {{ $address->country }}
                                    </address>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <address>
                                        <strong>Shipped To:</strong><br>
                                        <strong>Name:</strong> {{ $address->name }} <br>
                                        <strong>Email:</strong>{{ $address->email }}<br>
                                        <strong>Phone:</strong>{{ $address->phone }}<br>
                                        <strong>Address:</strong> {{ $address->address }} <br>
                                        {{ $address->city }} , {{ $address->state }} , {{ $address->zip }}
                                        {{ $address->country }}
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Payment Infomation:</strong><br>
                                        <strong>Method:</strong> {{ $order->payment_method }} <br>
                                        <strong>Transaction Id:</strong> {{ @$order->transaction->transaction_id }} <br>
                                        <strong>Status:</strong>
                                        {{ $order->payment_status == 1 ? 'Completed' : 'Pending' }}
                                    </address>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <address>
                                        <strong>Order Date:</strong><br>
                                        {{ date('d F,Y', strtotime($order->created_at)) }} <br><br>
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="section-title">Order Summary</div>
                            <p class="section-lead">All items here cannot be deleted.</p>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-md">
                                    <tr>
                                        <th data-width="40">#</th>
                                        <th>Item</th>
                                        <th>Variant</th>
                                        <th>Vendor Name</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-right">Totals</th>
                                    </tr>
                                    @foreach ($order->orderProducts as $product)
                                        @php
                                            $variants = json_decode($product->variants);
                                        @endphp
                                        <tr>
                                            <td> {{ ++$loop->index }} </td>
                                            @if (isset($product->product->slug))
                                                <td> <a target="_gaurav"
                                                        href="{{ route('product-details', $product->product->slug) }}">
                                                        {{ $product->product_name }}
                                                    </a></td>
                                            @else
                                                <td> {{ $product->product_name }} </td>
                                            @endif
                                            <td>
                                                @foreach ($variants as $key => $variant)
                                                    <strong> {{ $key }}: </strong> {{ $variant->name }}
                                                    ({{ $settings->currency_icon }}{{ $variant->price }})
                                                @endforeach
                                            </td>
                                            <td> {{ $product->vendor->shop_name }} </td>

                                            <td class="text-center"> {{ $settings->currency_icon }}
                                                {{ $product->unit_price }}
                                            </td>
                                            <td class="text-center"> {{ $product->qty }} </td>
                                            <td class="text-right"> {{ $settings->currency_icon }}
                                                {{-- {{ $product->unit_price * $product->qty + $product->variant_total }} --}}
                                                {{ ($product->unit_price + $product->variant_total) * $product->qty }}
                                            </td>
                                        </tr>
                                    @endforeach

                                </table>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-8">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Order status</label>
                                            <select class="form-control" name="order_status" data-id="{{ $order->id }}"
                                                id="order_status">
                                                @foreach (config('order_status.order_status_admin') as $key => $orderStatus)
                                                    <option {{ $order->order_status == $key ? 'selected' : '' }}
                                                        value="{{ $key }}"> {{ $orderStatus['status'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 text-right">
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Subtotal</div>
                                        <div class="invoice-detail-value">{{ $settings->currency_icon }}
                                            {{ $order->subtotal }} </div>
                                    </div>

                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Shipping (+)</div>
                                        <div class="invoice-detail-value">{{ $settings->currency_icon }}
                                            {{ @$shipping->cost }}</div>
                                    </div>

                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Coupon (-)</div>
                                        <div class="invoice-detail-value">{{ $settings->currency_icon }}
                                            {{ @$coupon->discount ? @$coupon->discount : 0 }}</div>
                                    </div>

                                    <hr class="mt-2 mb-2">
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Total</div>
                                        <div class="invoice-detail-value invoice-detail-value-lg">
                                            {{ $settings->currency_icon }}
                                            {{ $order->amount }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="text-md-right">
                    <div class="float-lg-left mb-lg-0 mb-3">
                        <button class="btn btn-primary btn-icon icon-left"><i class="fas fa-credit-card"></i>
                            Process Payment</button>
                        <button class="btn btn-danger btn-icon icon-left"><i class="fas fa-times"></i>
                            Cancel</button>
                    </div>
                    <button class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</button>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Adding csrf token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // Ajax token end

            $('#order_status').on('change', function() {
                let status = $(this).val();
                let id = $(this).data('id');
                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.order.status') }}",
                    data: {
                        status: status,
                        id: id
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            toastr.success(data.message);
                        }
                    },
                    error: function(xhr, status, error) {

                    }
                })
            })
        })
    </script>
@endpush
