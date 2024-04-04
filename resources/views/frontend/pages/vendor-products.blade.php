@extends('frontend.layouts.master')

@section('title')
    {{ $settings->site_name }} || Vendor-Products
@endsection

@section('content')
    {{-- BREADCRUMB START --}}
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Vendor Details</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">home</a></li>
                            <li><a href="javascripts:;">vendor products</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- BREADCRUMB END --}}


    {{-- PRODUCT PAGE START --}}
    <section id="wsus__product_page">
        <div class="container">
            <div class="row">
                {{-- Banner --}}

                <div class="col-xl-12">
                    <div class="wsus__pro_page_bammer vendor_det_banner">
                        <img src="{{ asset('frontend/images/vendor_details_banner.jpg') }}" alt="banner"
                            class="img-fluid w-100">
                        <div class="wsus__pro_page_bammer_text wsus__vendor_det_banner_text">
                            <div class="wsus__vendor_text_center">
                                <h4>{{ $vendor->shop_name }}</h4>
                                <p class="wsus__vendor_rating">
                                    <i class="fas fa-star" aria-hidden="true"></i>
                                    <i class="fas fa-star" aria-hidden="true"></i>
                                    <i class="fas fa-star" aria-hidden="true"></i>
                                    <i class="fas fa-star" aria-hidden="true"></i>
                                    <i class="fas fa-star-half-alt" aria-hidden="true"></i>
                                </p>
                                <a href="callto: {{ $vendor->phone }}">
                                    <i class="far fa-phone-alt" aria-hidden="true"></i>
                                    {{ $vendor->phone }}
                                </a>
                                <a href="mailto: {{ $vendor->email }}">
                                    <i class="far fa-envelope" aria-hidden="true"></i>
                                    {{ $vendor->email }}
                                </a>
                                <p class="wsus__vendor_location">
                                    <i class="fal fa-map-marker-alt" aria-hidden="true"></i>
                                    {{ $vendor->address }}
                                </p>
                                {{-- <p class="wsus__open_store"><i class="fab fa-shopify" aria-hidden="true">
                                    </i> store open
                                </p> --}}
                                <ul class="d-flex">
                                    <li>
                                        <a class="facebook" href="{{ $vendor->fb_link }}">
                                            <i class="fab fa-facebook-f" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="twitter" href="{{ $vendor->tw_link }}">
                                            <i class="fab fa-twitter" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    {{-- <li>
                                        <a class="whatsapp" href="#">
                                            <i class="fab fa-whatsapp" aria-hidden="true"></i>
                                        </a>
                                    </li> --}}
                                    <li>
                                        <a class="instagram" href="{{ $vendor->insta_link }}">
                                            <i class="fab fa-instagram" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                </ul>
                                {{-- <a class="common_btn" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="fas fa-star" aria-hidden="true"></i>
                                    add
                                    review
                                </a> --}}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Banner end --}}

                {{-- Removed following classes from the class --}}
                {{-- col-xl-12 col-lg-8 --}}
                <div class="">
                    <div class="row">
                        <div class="col-xl-12 d-none d-md-block mt-md-4 mt-lg-0">
                            <div class="wsus__product_topbar">
                                <div class="wsus__product_topbar_left">
                                    <div class="nav nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        {{-- Grid view --}}
                                        <button
                                            class="nav-link list-view {{ session()->has('product_list_style') && session()->get('product_list_style') == 'grid' ? 'active' : '' }}
                                            {{ !session()->has('product_list_style') ? 'active' : '' }}"
                                            data-id="grid" id="v-pills-home-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-home" type="button" role="tab"
                                            aria-controls="v-pills-home" aria-selected="true">
                                            <i class="fas fa-th"></i>
                                        </button>
                                        {{-- Grid view end --}}

                                        {{-- List view --}}
                                        <button
                                            class="nav-link list-view {{ session()->has('product_list_style') && session()->get('product_list_style') == 'list' ? 'active' : '' }} "
                                            data-id="list" id="v-pills-profile-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-profile" type="button" role="tab"
                                            aria-controls="v-pills-profile" aria-selected="false">
                                            <i class="fas fa-list-ul"></i>
                                        </button>
                                        {{-- List view end --}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content" id="v-pills-tabContent">
                            {{-- Grid view --}}
                            <div class="tab-pane fade {{ session()->has('product_list_style') && session()->get('product_list_style') == 'grid' ? 'show active' : '' }}
                                {{ !session()->has('product_list_style') ? 'show active' : '' }}"
                                id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                <div class="row">
                                    @foreach ($products as $product)
                                        <div class="col-xl-3 col-sm-6">
                                            <div class="wsus__product_item">
                                                <span class="wsus__new"> {{ productType($product->product_type) }} </span>
                                                @if (checkDiscount($product))
                                                    <span
                                                        class="wsus__minus">-{{ calculateDiscount($product->price, $product->offer_price) }}%</span>
                                                @endif

                                                {{-- Images links --}}
                                                <a class="wsus__pro_link"
                                                    href="{{ route('product-details', $product->slug) }}">
                                                    <img src="{{ asset($product->thumb_image) }}" alt="product"
                                                        class="img-fluid w-100 img_1" />

                                                    <img src="
                                                            @if (isset($product->productImageGallery[0]->image)) {{ asset($product->productImageGallery[0]->image) }}
                                                            @else
                                                            {{ asset($product->thumb_image) }} @endif"
                                                        alt="product" class="img-fluid w-100 img_2" />
                                                </a>

                                                <ul class="wsus__single_pro_icon">
                                                    {{-- Modal view of the product --}}
                                                    <li><a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal-{{ $product->id }}"><i
                                                                class="far fa-eye"></i></a></li>

                                                    <li><a href="" class="add_to_wishlist"
                                                            data-id="{{ $product->id }}"><i
                                                                class="far fa-heart"></i></a>
                                                    </li>
                                                    {{-- <li><a href="#"><i class="far fa-random"></i></a> --}}
                                                </ul>

                                                <div class="wsus__product_details">
                                                    <a class="wsus__category"
                                                        href="#">{{ $product->category->name }}
                                                    </a>
                                                    <p class="wsus__pro_rating">
                                                        @php
                                                            $avgRating = $product->reviews()->avg('rating');
                                                            $stars = round($avgRating);
                                                        @endphp

                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $stars)
                                                                <i class="fas fa-star"></i>
                                                            @else
                                                                <i class="far fa-star"></i>
                                                            @endif
                                                        @endfor

                                                        <span>({{ count($product->reviews) }} review)</span>
                                                    </p>
                                                    <a class="wsus__pro_name"
                                                        href="{{ route('product-details', $product->slug) }}">{{ $product->name }}
                                                    </a>
                                                    @if (checkDiscount($product))
                                                        <p class="wsus__price">
                                                            {{ $settings->currency_icon }} {{ $product->offer_price }}
                                                            <del>
                                                                {{ $settings->currency_icon }} {{ $product->price }}</del>
                                                        </p>
                                                    @else
                                                        <p class="wsus__price"> {{ $settings->currency_icon }}
                                                            {{ $product->price }}</p>
                                                    @endif

                                                    <form class="shopping-cart-form">
                                                        {{-- Hidden field of product Id --}}
                                                        <input type="hidden" name="product_id"
                                                            value="{{ $product->id }}">

                                                        @foreach ($product->variants as $variant)
                                                            <select class="d-none" name="variant_items[]">
                                                                @foreach ($variant->productVariantItems as $variantItem)
                                                                    <option value="{{ $variantItem->id }}"
                                                                        {{ $variantItem->is_default == 1 ? 'selected' : '' }}>
                                                                        {{ $variantItem->name }}
                                                                        (${{ $variantItem->price }})
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        @endforeach

                                                        <input name="qty" type="hidden" min="1"
                                                            max="100" value="1" />
                                                        <button type="submit" class="add_cart" href="#">add to
                                                            cart</button>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            {{-- Grid view end --}}

                            {{-- List view --}}
                            <div class="tab-pane fade {{ session()->has('product_list_style') && session()->get('product_list_style') == 'list' ? 'show active' : '' }}"
                                id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                <div class="row">
                                    @foreach ($products as $product)
                                        <div class="col-xl-12">
                                            <div class="wsus__product_item wsus__list_view">
                                                <span class="wsus__new"> {{ productType($product->product_type) }} </span>

                                                @if (checkDiscount($product))
                                                    <span
                                                        class="wsus__minus">-{{ calculateDiscount($product->price, $product->offer_price) }}%</span>
                                                @endif

                                                {{-- Images links --}}
                                                <a class="wsus__pro_link"
                                                    href="{{ route('product-details', $product->slug) }}">
                                                    <img src="{{ asset($product->thumb_image) }}" alt="product"
                                                        class="img-fluid w-100 img_1" />

                                                    <img src="
                                                            @if (isset($product->productImageGallery[0]->image)) {{ asset($product->productImageGallery[0]->image) }}
                                                            @else
                                                            {{ asset($product->thumb_image) }} @endif"
                                                        alt="product" class="img-fluid w-100 img_2" />
                                                </a>

                                                <div class="wsus__product_details">

                                                    <a class="wsus__category" href="#">
                                                        {{ @$product->category->name }}
                                                    </a>
                                                    <p class="wsus__pro_rating">
                                                        @php
                                                            $avgRating = $product->reviews()->avg('rating');
                                                            $stars = round($avgRating);
                                                        @endphp

                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $stars)
                                                                <i class="fas fa-star"></i>
                                                            @else
                                                                <i class="far fa-star"></i>
                                                            @endif
                                                        @endfor

                                                        <span>({{ count($product->reviews) }} review)</span>
                                                    </p>

                                                    <a class="wsus__pro_name"
                                                        href="{{ route('product-details', $product->slug) }}">{{ $product->name }}
                                                    </a>

                                                    @if (checkDiscount($product))
                                                        <p class="wsus__price">
                                                            {{ $settings->currency_icon }} {{ $product->offer_price }}
                                                            <del>
                                                                {{ $settings->currency_icon }} {{ $product->price }}</del>
                                                        </p>
                                                    @else
                                                        <p class="wsus__price"> {{ $settings->currency_icon }}
                                                            {{ $product->price }}</p>
                                                    @endif

                                                    <p class="list_description">
                                                        {!! $product->short_description !!}
                                                    </p>

                                                    <ul class="wsus__single_pro_icon">
                                                        <li>
                                                            <form class="shopping-cart-form">
                                                                {{-- Hidden field of product Id --}}
                                                                <input type="hidden" name="product_id"
                                                                    value="{{ $product->id }}">

                                                                @foreach ($product->variants as $variant)
                                                                    <select class="d-none" name="variant_items[]">
                                                                        @foreach ($variant->productVariantItems as $variantItem)
                                                                            <option value="{{ $variantItem->id }}"
                                                                                {{ $variantItem->is_default == 1 ? 'selected' : '' }}>
                                                                                {{ $variantItem->name }}
                                                                                (${{ $variantItem->price }})
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                @endforeach

                                                                <input name="qty" type="hidden" min="1"
                                                                    max="100" value="1" />
                                                                <button type="submit" class="add_cart_two">add to
                                                                    cart</button>
                                                            </form>
                                                        </li>
                                                        <li><a href="" class="add_to_wishlist"
                                                                data-id="{{ $product->id }}"><i
                                                                    class="far fa-heart"></i></a></li>
                                                        {{-- <li><a href="#"><i class="far fa-random"></i></a> --}}
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            {{-- List view end --}}

                        </div>

                    </div>
                    @if (count($products) == 0)
                        <div class="text-center mt-3">
                            <div class="card">
                                <div class="card-body">
                                    <h2>Product not found!</h2>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-xl-12">
                    <div class="mt-5" style="display: flex; justify-content:center">
                        @if ($products->hasPages())
                            {{ $products->withQueryString()->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- PRODUCT PAGE END --}}

    {{-- Product modal view --}}
    @foreach ($products as $product)
        <section class="product_popup_modal">
            <div class="modal fade" id="exampleModal-{{ $product->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                    class="far fa-times"></i></button>
                            <div class="row">
                                <div class="col-xl-6 col-12 col-sm-10 col-md-8 col-lg-6 m-auto display">
                                    <div class="wsus__quick_view_img">
                                        {{-- Youtube video link --}}
                                        @if ($product->video_link)
                                            <a class="venobox wsus__pro_det_video" data-autoplay="true"
                                                data-vbtype="video" href="{{ $product->video_link }}">
                                                <i class="fas fa-play"></i>
                                            </a>
                                        @endif

                                        <div class="row modal_slider">

                                            {{-- Product Image --}}
                                            <div class="col-xl-12">
                                                <div class="modal_slider_img">
                                                    <img src="{{ asset($product->thumb_image) }}"
                                                        alt="{{ $product->name }}" class="img-fluid w-100">
                                                </div>
                                            </div>

                                            @if (count($product->productImageGallery) === 0)
                                                <div class="col-xl-12">
                                                    <div class="modal_slider_img">
                                                        <img src="{{ asset($product->thumb_image) }}"
                                                            alt="{{ $product->name }}" class="img-fluid w-100">
                                                    </div>
                                                </div>
                                            @endif
                                            {{-- Product images from gallery --}}
                                            @foreach ($product->productImageGallery as $productImage)
                                                <div class="col-xl-12">
                                                    <div class="modal_slider_img">
                                                        <img src="{{ asset($productImage->image) }}"
                                                            alt="{{ $productImage->name }}" class="img-fluid w-100">
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-12 col-sm-12 col-md-12 col-lg-6">
                                    <div class="wsus__pro_details_text">
                                        <a class="title" href="#">{{ $product->name }}</a>
                                        <p class="wsus__stock_area"><span class="in_stock">in stock</span> (167 item)</p>

                                        {{-- Checking if the product has discount using helper function --}}
                                        @if (checkDiscount($product))
                                            <h4> {{ $settings->currency_icon }} {{ $product->offer_price }} <del>
                                                    {{ $settings->currency_icon }} {{ $product->price }}</del></h4>
                                        @else
                                            <h4> {{ $settings->currency_icon }} {{ $product->price }}</h4>
                                        @endif

                                        <p class="review">
                                            @php
                                                $avgRating = $product->reviews()->avg('rating');
                                                $stars = round($avgRating);
                                            @endphp

                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $stars)
                                                    <i class="fas fa-star"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor

                                            <span>({{ count($product->reviews) }} review)</span>
                                        </p>
                                        <p class="description">{!! $product->short_description !!}</p>

                                        <form class="shopping-cart-form">
                                            <div class="wsus__selectbox">
                                                <div class="row">

                                                    {{-- Hidden field of product Id --}}
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    {{-- Displaying variant that have status true --}}
                                                    @foreach ($product->variants as $variant)
                                                        @if ($variant->status != 0)
                                                            <div class="col-xl-6 col-sm-6">
                                                                <h5 class="mb-2">{{ $variant->name }}:</h5>
                                                                <select class="select_2" name="variant_items[]">
                                                                    {{-- Displaying variants item that have status true --}}
                                                                    @foreach ($variant->productVariantItems as $variantItem)
                                                                        @if ($variantItem->status != 0)
                                                                            <option value="{{ $variantItem->id }}"
                                                                                {{ $variantItem->is_default == 1 ? 'selected' : '' }}>
                                                                                {{ $variantItem->name }}
                                                                                (${{ $variantItem->price }})
                                                                            </option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        @endif
                                                    @endforeach

                                                </div>
                                            </div>


                                            <div class="wsus__quentity">
                                                <h5>quentity :</h5>
                                                <div class="select_number">
                                                    <input class="number_area" name="qty" type="text"
                                                        min="1" max="100" value="1" />
                                                </div>
                                            </div>

                                            <ul class="wsus__button_area">
                                                <li><button type="submit" class="add_cart" href="#">add to
                                                        cart</button></li>
                                                <li><a class="buy_now" href="#">buy now</a></li>
                                                <li><a href="" class="add_to_wishlist"
                                                        data-id="{{ $product->id }}"><i class="fal fa-heart"></i></a>
                                                </li>
                                                {{-- <li><a href="#"><i class="far fa-random"></i></a></li> --}}
                                            </ul>
                                        </form>
                                        {{-- <p class="brand_model"><span>model :</span> 12345670</p> --}}
                                        <p class="brand_model"><span>brand :</span>
                                            {{ $product->brand->name ?? 'not known' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endforeach
    {{-- Product modal view end --}}
@endsection

@push('scripts')
    <script>
        $('document').ready(function() {
            $('.list-view').on('click', function() {
                let style = $(this).data('id');
                $.ajax({
                    method: 'GET',
                    url: "{{ route('change-product-list-view') }}",
                    data: {
                        style: style
                    },

                    success: function(data) {

                    },

                    error: function(data) {

                    }

                })
            })
        })
        // Setting price range filter dynamically
        @php
            if (request()->has('range') && request()->range != '') {
                $price = explode(';', request()->range);
                $from = $price[0];
                $to = $price[1];
            } else {
                $from = 0;
                $to = 8000;
            }
        @endphp

        jQuery(function() {
            jQuery("#slider_range").flatslider({
                min: 0,
                max: 10000,
                step: 100,
                values: [{{ $from }}, {{ $to }}],
                range: true,
                einheit: '{{ $settings->currency_icon }}'
            });
        });
    </script>
@endpush
