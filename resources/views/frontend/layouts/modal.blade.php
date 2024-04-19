<div class="modal-body">
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="far fa-times"></i></button>
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
                            <img src="{{ asset($product->thumb_image) }}" alt="{{ $product->name }}"
                                class="img-fluid w-100">
                        </div>
                    </div>

                    {{-- @if (count($product->productImageGallery) === 0)
                        <div class="col-xl-12">
                            <div class="modal_slider_img">
                                <img src="{{ asset($product->thumb_image) }}"
                                    alt="{{ $product->name }}" class="img-fluid w-100">
                            </div>
                        </div>
                    @endif --}}
                    {{-- Product images from gallery --}}
                    {{-- @foreach ($product->productImageGallery as $productImage)
                        <div class="col-xl-12">
                            <div class="modal_slider_img">
                                <img src="{{ asset($productImage->image) }}"
                                    alt="{{ $productImage->name }}" class="img-fluid w-100">
                            </div>
                        </div>
                    @endforeach --}}

                </div>
            </div>
        </div>
        <div class="col-xl-6 col-12 col-sm-12 col-md-12 col-lg-6">
            <div class="wsus__pro_details_text">
                <a class="title" href="{{route('product-details', $product->slug)}}">{{ limitText($product->name, 150) }}</a>
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
                <p class="description">{!! limitText($product->short_description, 200) !!}</p>

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
                            <input class="number_area" name="qty" type="text" min="1" max="100"
                                value="1" />
                        </div>
                    </div>

                    <ul class="wsus__button_area">
                        <li><button type="submit" class="add_cart" href="#">add to
                                cart</button></li>

                        {{-- <li><a class="buy_now" href="#">buy now</a></li> --}}

                        <li><a href="" class="add_to_wishlist" data-id="{{ $product->id }}"><i
                                    class="fal fa-heart"></i></a>
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
