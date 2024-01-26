@extends('frontend.layouts.master')

@section('title')
    {{ $settings->site_name }} || Login
@endsection

@section('content')
    {{-- BREADCRUMB START --}}

    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>login / register</h4>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">login / register</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- BREADCRUMB END --}}

    {{-- LOGIN/REGISTER PAGE START --}}
    <section id="wsus__login_register">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 m-auto">
                    <div class="wsus__login_reg_area">
                        <ul class="nav nav-pills mb-3" id="pills-tab2" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab2" data-bs-toggle="pill"
                                    data-bs-target="#pills-homes" type="button" role="tab" aria-controls="pills-homes"
                                    aria-selected="true">login</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab2" data-bs-toggle="pill"
                                    data-bs-target="#pills-profiles" type="button" role="tab"
                                    aria-controls="pills-profiles" aria-selected="true">signup</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent2">
                            <div class="tab-pane fade show active" id="pills-homes" role="tabpanel"
                                aria-labelledby="pills-home-tab2">
                                <div class="wsus__login">

                                    {{-- Login Form --}}
                                    <form action="{{ route('login') }}" method="POST">
                                        @csrf

                                        {{-- This is the email field --}}
                                        <div class="wsus__login_input">
                                            <i class="fas fa-user-tie"></i>
                                            <input id="email" name="email" type="email" placeholder="Email"
                                                value="{{ old('email') }}">
                                        </div>
                                        {{-- This is the email field --}}

                                        {{-- This is the password field --}}
                                        <div class="wsus__login_input">
                                            <i class="fas fa-key"></i>
                                            <input id="password" name="password" type="password" placeholder="Password">
                                            {{-- required autocomplete="current-password"> --}} <!-- experiment with this fields later -->
                                        </div>
                                        {{-- This is the password field --}}

                                        {{-- This is the remember me field --}}
                                        <div class="wsus__login_save">
                                            <div class="form-check form-switch">
                                                <input id="remember_me" name="remember" class="form-check-input"
                                                    type="checkbox" id="flexSwitchCheckDefault">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Remember
                                                    me</label>
                                            </div>
                                            <a class="forget_p" href="{{ route('password.request') }}">forget password ?</a>
                                        </div>
                                        {{-- This is the remember me field End --}}

                                        <button class="common_btn" type="submit">login</button>

                                        {{-- Social Account Links --}}

                                        {{-- <p class="social_text">Sign in with social account</p>
                                        <ul class="wsus__login_link">
                                            <li><a href="#"><i class="fab fa-google"></i></a></li>
                                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                        </ul> --}}

                                        {{-- Social Account Links Ends --}}
                                    </form>

                                </div>
                            </div>
                            {{-- Login Form Ends --}}


                            <div class="tab-pane fade" id="pills-profiles" role="tabpanel"
                                aria-labelledby="pills-profile-tab2">
                                <div class="wsus__login">

                                    {{-- Register Form --}}
                                    <form action="{{ route('register') }}" method="POST">
                                        @csrf

                                        {{-- Name Field --}}
                                        <div class="wsus__login_input">
                                            <i class="fas fa-user-tie"></i>
                                            <input type="text" placeholder="Name" name="name" id="name"
                                                value="{{ old('name') }}">
                                        </div>
                                        {{-- Name Field End --}}

                                        {{-- Email Field --}}
                                        <div class="wsus__login_input">
                                            <i class="far fa-envelope"></i>
                                            <input type="email" placeholder="Email" name="email" id="email"
                                                value="{{ old('email') }}">
                                        </div>
                                        {{-- Email Field End --}}

                                        {{-- Password Field --}}
                                        <div class="wsus__login_input">
                                            <i class="fas fa-key"></i>
                                            <input type="password" placeholder="Password" name="password" id="password">
                                        </div>
                                        {{-- Password Field End --}}

                                        {{-- Confirm password Field --}}
                                        <div class="wsus__login_input">
                                            <i class="fas fa-key"></i>
                                            <input type="text" placeholder="Confirm Password"
                                                name="password_confirmation" id="password_confirmation">
                                        </div>
                                        {{-- Confirm password Field End --}}

                                        <button class="common_btn mt-4" type="submit">signup</button>
                                    </form>
                                    {{-- Register Form Ends --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- LOGIN/REGISTER PAGE END --}}
@endsection
