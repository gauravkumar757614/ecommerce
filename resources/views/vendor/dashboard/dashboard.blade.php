@extends('vendor.layouts.master')
@section('title')
    {{ $settings->site_name }} || Dashboard
@endsection
@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">

            {{-- Sidebar --}}
            @include('vendor.layouts.sidebar');
            {{-- Sidebar End --}}

            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content">
                        <div class="wsus__dashboard">
                            <div class="row">

                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item purple" href="{{ route('vendor.orders.index') }}">
                                        <i class="fas fa-cart-plus"></i>
                                        <p>Today's Orders</p>
                                        <h4 style="color: #ffff">{{ $todaysOrders }}</h4>
                                    </a>
                                </div>
                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item red" href="{{ route('vendor.orders.index') }}">
                                        <i class="fas fa-cart-plus"></i>
                                        <p>Pending Orders</p>
                                        <h4 style="color: #ffff">{{ $todaysPendingOrders }}</h4>
                                    </a>
                                </div>
                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item green" href="{{ route('vendor.orders.index') }}">
                                        <i class="fas fa-cart-plus"></i>
                                        <p>Total Orders</p>
                                        <h4 style="color: #ffff">{{ $totalOrders }}</h4>
                                    </a>
                                </div>


                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item red" href="{{ route('vendor.orders.index') }}">
                                        <i class="fas fa-cart-plus"></i>
                                        <p>Total Pending</p>
                                        <h4 style="color: #ffff">{{ $totalPendingOrders }}</h4>
                                    </a>
                                </div>

                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item blue" href="{{ route('vendor.orders.index') }}">
                                        <i class="fas fa-cart-plus"></i>
                                        <p>Total Complete</p>
                                        <h4 style="color: #ffff">{{ $totalCompletedOrders }}</h4>
                                    </a>
                                </div>

                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item purple" href="{{ route('vendor.products.index') }}">
                                        <i class="fas fa-cart-plus"></i>
                                        <p>Total Products</p>
                                        <h4 style="color: #ffff">{{ $totalProducts }}</h4>
                                    </a>
                                </div>

                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item purple" href="javascript:;">
                                        <i class="fas fa-cart-plus"></i>
                                        <p>Todays Earned</p>
                                        <h4 style="color: #ffff"> {{ $settings->currency_icon }} {{ $todaysEarnings }}</h4>
                                    </a>
                                </div>

                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item purple" href="javascript:;">
                                        <i class="fas fa-cart-plus"></i>
                                        <p>Month Earning</p>
                                        <h4 style="color: #ffff"> {{ $settings->currency_icon }} {{ $thisMonthEarnings }}
                                        </h4>
                                    </a>
                                </div>

                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item purple" href="javascript:;">
                                        <i class="fas fa-cart-plus"></i>
                                        <p>Year Earning</p>
                                        <h4 style="color: #ffff"> {{ $settings->currency_icon }} {{ $thisYearEarnings }}
                                        </h4>
                                    </a>
                                </div>

                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item purple" href="javascript:;">
                                        <i class="fas fa-cart-plus"></i>
                                        <p>Total Earning</p>
                                        <h4 style="color: #ffff"> {{ $settings->currency_icon }} {{ $totalEarnings }}</h4>
                                    </a>
                                </div>

                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item purple" href="{{ route('vendor.reviews.index') }}">
                                        <i class="fas fa-star"></i>
                                        <p>Total Reviews</p>
                                        <h4 style="color: #ffff"> {{ $totalReviews }}</h4>
                                    </a>
                                </div>

                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item orange" href="{{ route('vendor.shop-profile.index') }}">
                                        <i class="fas fa-user-shield"></i>
                                        <p>Shop Profile</p>
                                        <h4 style="color: #ffff"> - </h4>
                                    </a>
                                </div>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
