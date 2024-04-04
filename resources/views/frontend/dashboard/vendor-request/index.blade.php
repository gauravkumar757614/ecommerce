@extends('frontend.dashboard.layouts.master')

@section('title')
    {{ $settings->site_name }} || Become Vendor
@endsection

@section('content')
    {{-- DASHBOARD START --}}
    <section id="wsus__dashboard">
        <div class="container-fluid">
            {{-- Sidebar --}}
            @include('frontend.dashboard.layouts.sidebar');
            {{-- Sidebar End --}}


            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> Became a vendor today! </h3>

                        {{-- Instruction by admin to user for becoming a vendor --}}
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                {!! @$content->content !!}
                            </div>
                        </div>

                        <br>
                        {{-- Vendor request form --}}
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <form action="{{ route('user.vendor-request.create') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    {{-- Shop image --}}
                                    <div class="wsus__dash_pro_single">
                                        <i class="fas fa-user-tie" aria-hidden="true"></i>
                                        <input type="file" name="shop_image" placeholder="Shop banner image...">
                                    </div>
                                    {{-- Shop name --}}
                                    <div class="wsus__dash_pro_single">
                                        <i class="fas fa-user-tie" aria-hidden="true"></i>
                                        <input type="text" name="shop_name" placeholder="Shop name...">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="wsus__dash_pro_single">
                                                <i class="fas fa-user-tie" aria-hidden="true"></i>
                                                <input type="email" name="shop_email" placeholder="Shop email...">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="wsus__dash_pro_single">
                                                <i class="fas fa-user-tie" aria-hidden="true"></i>
                                                <input type="text" name="shop_phone" placeholder="Shop phone...">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Address --}}
                                    <div class="wsus__dash_pro_single">
                                        <i class="fas fa-user-tie" aria-hidden="true"></i>
                                        <input type="text" name="shop_address" placeholder="Shop address...">
                                    </div>

                                    {{-- About you --}}
                                    <div class="wsus__dash_pro_single">
                                        <textarea name="about" placeholder="About you..."> </textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- DASHBOARD START --}}
@endsection
