<section id="wsus__hot_deals" class="wsus__hot_deals_2">
    <div class="container">

        <div class="wsus__hot_large_item">
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__section_header justify-content-start">
                        <div class="monthly_top_filter2 mb-1">
                            <button class="active auto_click" data-filter=".new_arrival">New Arrival</button>
                            <button data-filter=".featured_product">Featured product</button>
                            <button data-filter=".top_product">Top product</button>
                            <button data-filter=".best_product">Best product</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row grid2">
                @foreach ($typeBaseProducts as $key => $products)
                    @foreach ($products as $product)
                        <x-product-card :product="$product" :key="$key" />
                    @endforeach
                @endforeach

            </div>
        </div>

        <section id="wsus__single_banner" class="home_2_single_banner">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6">
                        <div class="wsus__single_banner_content banner_1">

                            @if ($banner_three_content['banner_one']['banner_status'] == 1)
                                <div class="wsus__single_banner_img">
                                    <a href="{{ $banner_three_content['banner_one']['banner_url'] }}">
                                        <img src="{{ asset($banner_three_content['banner_one']['banner_image']) }}"
                                            alt="banner" class="img-fluid w-100">
                                    </a>
                                </div>
                            @endif

                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="row">
                            <div class="col-12">
                                <div class="wsus__single_banner_content single_banner_2">
                                    @if ($banner_three_content['banner_two']['banner_status'] == 1)
                                        <div class="wsus__single_banner_img">
                                            <a href="{{ $banner_three_content['banner_two']['banner_url'] }}">
                                                <img src="{{ asset($banner_three_content['banner_two']['banner_image']) }}"
                                                    alt="banner" class="img-fluid w-100">
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 mt-lg-4">
                                <div class="wsus__single_banner_content">
                                    @if ($banner_three_content['banner_three']['banner_status'] == 1)
                                        <div class="wsus__single_banner_img">
                                            <a href="{{ $banner_three_content['banner_three']['banner_url'] }}">
                                                <img src="{{ asset($banner_three_content['banner_three']['banner_image']) }}"
                                                    alt="banner" class="img-fluid w-100">
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>
