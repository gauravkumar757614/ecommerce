<section id="wsus__single_banner" class="wsus__single_banner_2">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6">
                    @if ($banner_two_content['banner_one']['banner_status'] == 1)
                    <div class="wsus__single_banner_content">
                        <a href="{{ $banner_two_content['banner_one']['banner_url'] }}">
                            <img src="{{ $banner_two_content['banner_one']['banner_image'] }}" alt="">
                        </a>
                    </div>
                @endif
            </div>

            <div class="col-xl-6 col-lg-6">
                @if ($banner_two_content['banner_two']['banner_status'] == 1)
                    <div class="wsus__single_banner_content single_banner_2">
                        <a href="{{ $banner_two_content['banner_two']['banner_url'] }}">
                            <img src="{{ $banner_two_content['banner_two']['banner_image'] }}" alt="">
                        </a>
                    </div>
                @endif
            </div>
        </div>
</section>
