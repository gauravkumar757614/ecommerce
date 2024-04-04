<section id="wsus__single_banner" class="wsus__single_banner_2">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6">
                {{-- <div class="wsus__single_banner_content"> --}}
                {{-- <div class="wsus__single_banner_img">
                        <img src="images/single_banner_7.jpg" alt="banner" class="img-fluid w-100">
                    </div>
                    <div class="wsus__single_banner_text">
                        <h6>sell on <span>35% off</span></h6>
                        <h3>smart watch</h3>
                        <a class="shop_btn" href="#">shop now</a>
                    </div> --}}
                @if ($banner_two_content['banner_one']['banner_status'] == 1)
                    <div class="wsus__single_banner_content">
                        <a href="{{ $banner_two_content['banner_one']['banner_url'] }}">
                            <img src="{{ $banner_two_content['banner_one']['banner_image'] }}" alt="">
                        </a>
                    </div>
                @endif
            </div>

            <div class="col-xl-6 col-lg-6">
                {{-- <div class="wsus__single_banner_content single_banner_2"> --}}
                {{-- <div class="wsus__single_banner_img">
                        <img src="images/single_banner_8.jpg" alt="banner" class="img-fluid w-100">
                    </div>
                    <div class="wsus__single_banner_text">
                        <h6>New Collection</h6>
                        <h3>bicycle</h3>
                        <a class="shop_btn" href="#">shop now</a>
                    </div> --}}

                @if ($banner_two_content['banner_two']['banner_status'] == 1)
                    <div class="wsus__single_banner_content single_banner_2">
                        <a href="{{ $banner_two_content['banner_two']['banner_url'] }}">
                            <img src="{{ $banner_two_content['banner_two']['banner_image'] }}" alt="">
                        </a>
                    </div>
                @endif
                {{-- </div> --}}
            </div>
        </div>
</section>
