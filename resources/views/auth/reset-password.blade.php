@extends('frontend.layouts.master')

@section('title')
    {{ $settings->site_name }} || Reset-Password
@endsection

@section('content')
    {{-- BREADCRUMB START --}}
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Reset password</h4>
                        <ul>
                            <li><a href="#">login</a></li>
                            <li><a href="#">Reset password</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- BREADCRUMB END --}}

    {{-- CHANGE PASSWORD START --}}
    <section id="wsus__login_register">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-md-10 col-lg-7 m-auto">
                    {{-- Reset Password Form --}}
                    <form method="POST" action="{{ route('password.store') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <div class="wsus__change_password">

                            <h4>reset password</h4>
                            {{-- Email Field --}}
                            <div class="wsus__single_pass">
                                <label>Email</label>
                                <input type="email" placeholder="Enter your email" name="email" id="email"
                                    value="{{ old('email', $request->email) }}">
                            </div>
                            {{-- Email Field End --}}

                            {{-- New Password Field --}}
                            <div class="wsus__single_pass">
                                <label>new password</label>
                                <input type="password" placeholder="New Password" name="password" id="password">
                            </div>
                            {{-- New Password Field End --}}

                            {{-- Password Confirmation Field --}}
                            <div class="wsus__single_pass">
                                <label>confirm password</label>
                                <input type="password" placeholder="Confirm Password" name="password_confirmation"
                                    id="password_confirmation">
                            </div>
                            {{-- Password Confirmation Field End --}}

                            <button class="common_btn" type="submit">submit</button>

                        </div>
                    </form>
                    {{-- Reset Password Form End --}}
                </div>
            </div>
        </div>
    </section>
    {{-- CHANGE PASSWORD END --}}
@endsection
