@extends('vendor.layouts.master');


@section('title')
    {{ $settings->site_name }} || Shop-Profile
@endsection

@section('content')
    {{-- DASHBOARD START --}}
    <section id="wsus__dashboard">
        <div class="container-fluid">
            {{-- Sidebar --}}
            @include('vendor.layouts.sidebar');
            {{-- Sidebar End --}}

            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> Shop Profile</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">

                                {{-- Shop profile form --}}
                                <form action="{{ route('vendor.shop-profile.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    {{-- Preview Image Field --}}
                                    <div class="form-group wsus_input">
                                        <label for="">Preview</label>
                                        <br>
                                        <img src="{{ asset($profile->banner) }}" alt="vendor_profile_images" srcset=""
                                            width="200">
                                    </div>
                                    {{-- Preview Image Field End --}}

                                    {{-- Image Field --}}
                                    <div class="form-group wsus_input">
                                        <label for="">Banner</label>
                                        <input type="file" class="form-control" name="banner">
                                    </div>
                                    {{-- Image Field End --}}

                                    {{-- Shop Name Field --}}
                                    <div class="form-group wsus_input">
                                        <label for="">Shop Name</label>
                                        <input type="text" class="form-control" name="shop_name"
                                            value="{{ $profile->shop_name }}">
                                    </div>
                                    {{-- Shop Name Field End --}}

                                    {{-- Phone Field --}}
                                    <div class="form-group wsus_input">
                                        <label for="">Phone</label>
                                        <input type="text" class="form-control" name="phone"
                                            value="{{ $profile->phone }}">
                                    </div>
                                    {{-- Phone Field End --}}

                                    {{-- Email Field --}}
                                    <div class="form-group wsus_input">
                                        <label for="">Email</label>
                                        <input type="email" class="form-control" name="email"
                                            value="{{ $profile->email }}">
                                    </div>
                                    {{-- Email Field End --}}

                                    {{-- Address Field --}}
                                    <div class="form-group wsus_input">
                                        <label for="">Address</label>
                                        <input type="text" class="form-control" name="address"
                                            value="{{ $profile->address }}">
                                    </div>
                                    {{-- Address Field End --}}

                                    {{-- Description Field --}}
                                    <div class="form-group wsus_input">
                                        <label for="">Description</label>
                                        <textarea name="description" class="summernote"> {{ $profile->description }}</textarea>
                                    </div>
                                    {{-- Description Field End --}}

                                    {{-- Facebook link Field --}}
                                    <div class="form-group wsus_input">
                                        <label for="">Facebook</label>
                                        <input type="text" class="form-control" name="fb_link"
                                            value="{{ $profile->fb_link }}">
                                    </div>
                                    {{-- Facebook link Field End --}}

                                    {{-- Twitter link Field --}}
                                    <div class="form-group wsus_input">
                                        <label for="">Twitter</label>
                                        <input type="text" class="form-control" name="tw_link"
                                            value="{{ $profile->tw_link }}">
                                    </div>
                                    {{-- Twitter link Field End --}}

                                    {{-- Instagram link Field --}}
                                    <div class="form-group wsus_input">
                                        <label for="">Instagram</label>
                                        <input type="text" class="form-control" name="insta_link"
                                            value="{{ $profile->insta_link }}">
                                    </div>
                                    {{-- Instagram link Field End --}}

                                    <button class="btn btn-primary" type="submit">Update</button>
                                </form>
                                {{-- Shop profile form end --}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- DASHBOARD START --}}
@endsection
