<div class="col-xl-3 col-sm-6 col-lg-4 {{ @$key }}">

    <div class="wsus__product_item">
        <span class="wsus__new"> {{ productType($product->product_type) }} </span>
        @if (checkDiscount($product))
            <span class="wsus__minus">-{{ calculateDiscount($product->price, $product->offer_price) }}%</span>
        @endif

        {{-- Images links --}}
        <a class="wsus__pro_link" href="{{ route('product-details', $product->slug) }}">
            <img src="{{ asset($product->thumb_image) }}" alt="product" class="img-fluid w-100 img_1" />

            <img src="
            @if (isset($product->productImageGallery[0]->image)) {{ asset($product->productImageGallery[0]->image) }}
            @else
                {{ asset($product->thumb_image) }} @endif"
                alt="product" class="img-fluid w-100 img_2" />
        </a>

        <ul class="wsus__single_pro_icon">
            <li>
                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" class="show_product_modal"
                    data-id="{{ $product->id }}">
                    <i class="far fa-eye"></i>
                </a>
            </li>
            <li><a href="" class="add_to_wishlist" data-id="{{ $product->id }}">
                    <i class="far fa-heart"></i>
                </a>
            </li>
            {{-- <li>
                <a href="#"><i class="far fa-random"></i>
                </a>
            </li> --}}
        </ul>

        <div class="wsus__product_details">
            <a class="wsus__category" href="#">{{ $product->category->name }} </a>

            <p class="wsus__pro_rating">

                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $product->reviews_avg_rating)
                        <i class="fas fa-star"></i>
                    @else
                        <i class="far fa-star"></i>
                    @endif
                @endfor

                <span>({{ $product->reviews_count }} review)</span>
            </p>
            <a class="wsus__pro_name"
                href="{{ route('product-details', $product->slug) }}">{{ limitText($product->name, 30) }}</a>
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
