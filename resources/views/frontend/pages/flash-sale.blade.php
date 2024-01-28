@extends('frontend.layouts.master')

@section('title')
    {{ $settings->site_name }} || Flash-Sale
@endsection

@section('content')
    {{-- BREADCRUMB START --}}
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Flash Sale</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="javascipt:;">Flash Sale</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- BREADCRUMB END --}}


    {{-- DAILY DEALS DETAILS START --}}
    <section id="wsus__daily_deals">
        <div class="container">
            <div class="wsus__offer_details_area">
                <div class="row">
                    <div class="col-xl-6 col-md-6">
                        <div class="wsus__offer_details_banner">
                            <img src="{{ asset('frontend/images/offer_banner_2.png') }}" alt="offrt img"
                                class="img-fluid w-100">
                            <div class="wsus__offer_details_banner_text">
                                <p>apple watch</p>
                                <span>up 50% 0ff</span>
                                <p>for all poduct</p>
                                <p><b>today only</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6">
                        <div class="wsus__offer_details_banner">
                            <img src="{{ asset('frontend/images/offer_banner_3.png') }}" alt="offrt img"
                                class="img-fluid w-100">
                            <div class="wsus__offer_details_banner_text">
                                <p>xiaomi power bank</p>
                                <span>up 37% 0ff</span>
                                <p>for all poduct</p>
                                <p><b>today only</b></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="wsus__section_header rounded-0">
                            <h3>flash sell</h3>
                            <div class="wsus__offer_countdown">
                                <span class="end_text">ends time :</span>
                                <div class="simply-countdown simply-countdown-one"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    {{-- Product Card --}}
                    @foreach ($flashSaleItems as $item)
                        @php
                            $product = \App\Models\Product::find($item->product_id);
                        @endphp

                        <div class="col-xl-3 col-sm-6 col-lg-4">

                            <div class="wsus__product_item">
                                <span class="wsus__new"> {{ productType($product->product_type) }} </span>
                                @if (checkDiscount($product))
                                    <span
                                        class="wsus__minus">-{{ calculateDiscount($product->price, $product->offer_price) }}%</span>
                                @endif

                                {{-- Images links --}}
                                <a class="wsus__pro_link" href="{{ route('product-details', $product->slug) }}">
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

                                    <li><a href="#"><i class="far fa-heart"></i></a></li>
                                    <li><a href="#"><i class="far fa-random"></i></a>
                                </ul>

                                <div class="wsus__product_details">
                                    <a class="wsus__category" href="#">{{ $product->category->name }} </a>
                                    <p class="wsus__pro_rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <span>(133 review)</span>
                                    </p>
                                    <a class="wsus__pro_name"
                                        href="{{ route('product-details', $product->slug) }}">{{ $product->name }}</a>
                                    @if (checkDiscount($product))
                                        <p class="wsus__price">
                                            {{ $settings->currency_icon }} {{ $product->offer_price }} <del>
                                                {{ $settings->currency_icon }} {{ $product->price }}</del>
                                        </p>
                                    @else
                                        <p class="wsus__price"> {{ $settings->currency_icon }} {{ $product->price }}</p>
                                    @endif

                                    <form class="shopping-cart-form">
                                        {{-- Hidden field of product Id --}}
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                                        @foreach ($product->variants as $variant)
                                            <select class="d-none" name="variant_items[]">
                                                @foreach ($variant->productVariantItems as $variantItem)
                                                    <option value="{{ $variantItem->id }}"
                                                        {{ $variantItem->is_default == 1 ? 'selected' : '' }}>
                                                        {{ $variantItem->name }} (${{ $variantItem->price }})</option>
                                                @endforeach
                                            </select>
                                        @endforeach

                                        <input name="qty" type="hidden" min="1" max="100" value="1" />
                                        <button type="submit" class="add_cart" href="#">add to cart</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- Product Card End --}}

                </div>

                <div class="mt-5">
                    @if ($flashSaleItems->hasPages())
                        {{ $flashSaleItems->links() }}
                    @endif
                </div>
            </div>
        </div>
    </section>
    {{-- DAILY DEALS DETAILS END --}}


    {{-- PRODUCT MODAL VIEW START --}}
    @foreach ($flashSaleItems as $item)
        @php
            $product = \App\Models\Product::find($item->product_id);
        @endphp
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
                                            <a class="venobox wsus__pro_det_video" data-autoplay="true" data-vbtype="video"
                                                href="{{ $product->video_link }}">
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
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                            <span>20 review</span>
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
                                                <li><a href="#"><i class="fal fa-heart"></i></a></li>
                                                <li><a href="#"><i class="far fa-random"></i></a></li>
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
    {{-- PRODUCT MODAL VIEW END --}}
@endsection



@push('scripts')
    <script>
        $(document).ready(function() {
            // default example
            simplyCountdown('.simply-countdown-one', {
                year: {{ Date('Y', strtotime($flashSaleDate->end_date)) }},
                month: {{ Date('m', strtotime($flashSaleDate->end_date)) }},
                day: {{ Date('d', strtotime($flashSaleDate->end_date)) }},
            });

        })
    </script>
@endpush
