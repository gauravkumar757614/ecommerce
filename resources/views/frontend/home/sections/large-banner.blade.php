<section id="wsus__large_banner">
    <div class="container">
        <div class="row">
            <div class="cl-xl-12">
                {{-- <div class="wsus__large_banner_content" style="background: url(images/large_banner_img.jpg);">
                    <div class="wsus__large_banner_content_overlay">
                        <div class="row">
                            <div class="col-xl-6 col-12 col-md-6">
                                <div class="wsus__large_banner_text">
                                    <h3>This Week's Deal</h3>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem repudiandae in
                                        ipsam
                                        nesciunt.</p>
                                    <a class="shop_btn" href="#">view more</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div> --}}

                @if ($banner_four_content['banner_one']['status'] == 1)
                    <div class="wsus__single_banner_img">
                        <a href="{{ $banner_four_content['banner_one']['banner_url'] }}">
                            <img src="{{ asset($banner_four_content['banner_one']['banner_image']) }}" alt="banner"
                                class="img-fluid w-100">
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
