@php
    $categoryProductSliderSectionTwo = json_decode($categoryProductSliderSectionTwo->value, true);
    $lastKey = [];
    foreach ($categoryProductSliderSectionTwo as $key => $category) {
        if ($category == null) {
            break;
        }
        $lastKey = [$key => $category];
    }

    if (array_keys($lastKey)[0] == 'category') {
        // Category model
        $category = \App\Models\Category::find($lastKey['category']);

        $products = \App\Models\Product::withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->with(['category', 'variants', 'productImageGallery'])
            ->where('category_id', $category->id)
            ->orderBy('id', 'desc')
            ->take(12)
            ->get();
    } elseif (array_keys($lastKey)[0] == 'sub_category') {
        // Sub category model
        $category = \App\Models\SubCategory::find($lastKey['sub_category']);

        $products = \App\Models\Product::withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->with(['category', 'variants', 'productImageGallery'])
            ->where('sub_category_id', $category->id)
            ->orderBy('id', 'desc')
            ->take(12)
            ->get();
    } else {
        // Child category model
        $category = \App\Models\ChildCategory::find($lastKey['child_category']);

        $products = \App\Models\Product::withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->with(['category', 'variants', 'productImageGallery'])
            ->where('child_category_id', $category->id)
            ->orderBy('id', 'desc')
            ->take(12)
            ->get();
    }
@endphp

<section id="wsus__electronic2">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="wsus__section_header">
                    <h3> {{ $category->name }} </h3>
                    <a class="see_btn" href="{{ route('products.index', ['category' => $category->slug]) }}">see more <i
                            class="fas fa-caret-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row flash_sell_slider">
            @foreach ($products as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
    </div>
</section>

