@extends('frontend.layouts.master')
@section('title')
    {{ $settings->site_name }} || Cart-Details
@endsection

@section('content')
    {{-- BREADCRUMB START --}}
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>cart View</h4>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">products</a></li>
                            <li><a href="#">cart view</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- BREADCRUMB END --}}


    {{-- CART VIEW PAGE START --}}
    <section id="wsus__cart_view">
        <div class="container">
            <div class="row">
                <div class="col-xl-9">
                    <div class="wsus__cart_list">
                        <div class="table-responsive">
                            <table>
                                <tbody>
                                    {{-- Table header --}}
                                    <tr class="d-flex">
                                        <th class="wsus__pro_img">
                                            product item
                                        </th>

                                        <th class="wsus__pro_name">
                                            product details
                                        </th>

                                        <th class="wsus__pro_tk">
                                            unit price
                                        </th>

                                        <th class="wsus__pro_tk">
                                            total price
                                        </th>

                                        <th class="wsus__pro_select">
                                            quantity
                                        </th>

                                        <th class="wsus__pro_icon">
                                            <a href="#" class="common_btn clear_cart">clear cart</a>
                                        </th>
                                    </tr>
                                    {{-- Table header end --}}

                                    {{-- Looping through all cart items --}}
                                    @foreach ($cartItems as $item)
                                        <tr class="d-flex">
                                            <td class="wsus__pro_img"><img src="{{ $item->options->image }}" alt="product"
                                                    class="img-fluid w-100">
                                            </td>

                                            <td class="wsus__pro_name">
                                                <p>{!! $item->name !!}</p>
                                                @foreach ($item->options->variants as $key => $variant)
                                                    <span>{{ $key }} : {{ $variant['name'] }}
                                                        ({{ $settings->currency_icon . $variant['price'] }})
                                                    </span>
                                                @endforeach
                                            </td>

                                            <td class="wsus__pro_tk">
                                                <h6>{{ $settings->currency_icon . $item->price }}</h6>
                                            </td>

                                            <td class="wsus__pro_tk">
                                                <h6 id="{{ $item->rowId }}">
                                                    {{ $settings->currency_icon . ($item->price + $item->options->variants_total) * $item->qty }}
                                                </h6>
                                            </td>

                                            <td class="wsus__pro_select">
                                                <div class="product_qty_wrapper">
                                                    <button class="btn btn-danger product-decrement">
                                                        -
                                                    </button>
                                                    <input class="product_qty" data-rowid="{{ $item->rowId }}"
                                                        type="text" min="1" max="100"
                                                        value="{{ $item->qty }}" readonly />
                                                    <button class="btn btn-success product-increment">
                                                        +
                                                    </button>
                                                </div>
                                            </td>

                                            <td class="wsus__pro_icon">
                                                <a href="{{ route('cart.remove-product', $item->rowId) }}"><i
                                                        class="far fa-times"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    {{-- Looping through all cart items end --}}

                                    {{-- If the cart is empty displaying the message "Cart is empty" --}}
                                    @if (count($cartItems) === 0)
                                        <tr class="d-flex">
                                            <td class="wsus__pro_icon" style="width:100%">
                                                Cart is empty
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3">
                    <div class="wsus__cart_list_footer_button" id="sticky_sidebar">
                        <h6>total cart</h6>

                        {{-- Subtotal amount --}}
                        <p>subtotal: <span id="sub_total"> {{ $settings->currency_icon }} {{ getCartTotal() }}</span></p>

                        {{-- Discount amount --}}
                        <p>discount(-): <span id="discount">{{ $settings->currency_icon }}
                                {{ getCouponDiscount() }}</span>
                        </p>

                        {{-- Total payable amount --}}
                        <p class="total"><span>total:</span> <span id="cart_total"> {{ $settings->currency_icon }}
                                {{ getTotalPayable() }} </span></p>

                        <form id="coupon_form">
                            {{-- Coupon code --}}
                            <input type="text" placeholder="Coupon Code" name="coupon_code"
                                value="{{ session()->has('coupon') ? session()->get('coupon')['coupon_code'] : '' }} ">

                            <button type="submit" class="common_btn">apply</button>
                        </form>

                        <a class="common_btn mt-4 w-100 text-center" href="{{ route('user.checkout.index') }}">checkout</a>
                        <a class="common_btn mt-1 w-100 text-center" href="{{ route('home') }}"><i
                                class="fab fa-shopify"></i> keep shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="wsus__single_banner">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content">
                        {{-- <div class="wsus__single_banner_img">
                            <img src="images/single_banner_2.jpg" alt="banner" class="img-fluid w-100">
                        </div>
                        <div class="wsus__single_banner_text">
                            <h6>sell on <span>35% off</span></h6>
                            <h3>smart watch</h3>
                            <a class="shop_btn" href="#">shop now</a>
                        </div> --}}

                        @if ($cartpage_content['banner_one']['banner_status'] == 1)
                            <div class="wsus__single_banner_img">
                                <a href="{{ $cartpage_content['banner_one']['banner_url'] }}">
                                    <img src="{{ asset($cartpage_content['banner_one']['banner_image']) }}"
                                        alt="img" class="img-fluid w-100">
                                </a>
                            </div>
                        @endif


                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content single_banner_2">
                        {{-- <div class="wsus__single_banner_img">
                            <img src="images/single_banner_3.jpg" alt="banner" class="img-fluid w-100">
                        </div>
                        <div class="wsus__single_banner_text">
                            <h6>New Collection</h6>
                            <h3>Cosmetics</h3>
                            <a class="shop_btn" href="#">shop now</a>
                        </div> --}}

                        @if ($cartpage_content['banner_two']['banner_status'] == 1)
                            <div class="wsus__single_banner_img">
                                <a href="{{ $cartpage_content['banner_two']['banner_url'] }}">
                                    <img src="{{ asset($cartpage_content['banner_two']['banner_image']) }}"
                                        alt="img" class="img-fluid w-100">
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- CART VIEW PAGE END --}}
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
            $('.product-increment').on('click', function() {

                let input = $(this).siblings('.product_qty');
                let quantity = parseInt(input.val()) + 1;
                let rowId = input.data('rowid');
                input.val(quantity);

                // Increment product quantity
                $.ajax({
                    url: "{{ route('cart.update-quantity') }}",
                    method: "POST",
                    data: {
                        rowId: rowId,
                        quantity: quantity
                    },
                    success: function(data) {
                        if (data.status === 'success') {
                            let productId = '#' + rowId;
                            let totalAmount = "{{ $settings->currency_icon }}" + data
                                .product_total;
                            $(productId).text(totalAmount);

                            renderCartSubTotal();
                            calculateCouponDiscount();

                            toastr.success(data.message);
                        } else if (data.status === 'error') {
                            toastr.error(data.message);
                        }
                    },
                    error: function(data) {

                    }
                })


            })

            // decrement product quantity
            $('.product-decrement').on('click', function() {

                let input = $(this).siblings('.product_qty');
                let quantity = parseInt(input.val()) - 1;
                let rowId = input.data('rowid');

                if (quantity < 1) {
                    quantity = 1;
                }
                input.val(quantity);

                $.ajax({
                    url: "{{ route('cart.update-quantity') }}",
                    method: "POST",
                    data: {
                        rowId: rowId,
                        quantity: quantity
                    },
                    success: function(data) {
                        if (data.status === 'success') {
                            let productId = '#' + rowId;
                            let totalAmount = "{{ $settings->currency_icon }}" + data
                                .product_total;
                            $(productId).text(totalAmount);

                            renderCartSubTotal();
                            calculateCouponDiscount();

                            toastr.success(data.message);
                        } else if (data.status === 'error') {
                            toastr.error(data.message);
                        }
                    },
                    error: function(data) {

                    }
                })


            })

            // clear cart
            $('.clear_cart').on('click', function(e) {
                e.preventDefault();

                // Sweet alert
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Clear Cart!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, clear it!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        // Ajax start
                        $.ajax({
                            type: 'get',
                            url: "{{ route('clear.cart') }}",

                            success: function(data) {

                                if (data.status == 'success') {
                                    Swal.fire(
                                        'Deleted!',
                                        data.message,
                                        'success'
                                    )
                                    window.location.reload();
                                } else if (data.status == 'error') {
                                    Swal.fire(
                                        'Deleted!',
                                        data.message,
                                        'error'
                                    )
                                }
                                window.location.reload();

                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                            }
                        })
                        // Ajax end
                    }
                })
                // Sweet alert end
            })

            function renderCartSubTotal() {
                $.ajax({
                    type: 'get',
                    url: "{{ route('cart.sidebar-products-total') }}",

                    success: function(data) {
                        $('#sub_total').text("{{ $settings->currency_icon }}" + data)
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            }

            // Apply coupon on product
            $('#coupon_form').on('submit', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();
                $.ajax({
                    type: 'get',
                    url: "{{ route('apply-coupon') }}",
                    data: formData,
                    success: function(data) {
                        if (data.status === 'error') {
                            toastr.error(data.message);
                        } else if (data.status === 'success') {
                            calculateCouponDiscount();
                            toastr.success(data.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            })

            // Calculating the coupon discount account

            function calculateCouponDiscount() {
                $.ajax({
                    type: 'get',
                    url: "{{ route('coupon-calculation') }}",
                    success: function(data) {
                        if (data.status === 'success') {
                            $('#discount').text('{{ $settings->currency_icon }}' + data.discount);
                            $('#cart_total').text('{{ $settings->currency_icon }}' + data.cart_total);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            }
        })
    </script>
@endpush
