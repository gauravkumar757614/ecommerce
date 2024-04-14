@extends('vendor.layouts.master')


@section('title')
    {{ $settings->site_name }} || Withdraw
@endsection

@section('content')
    {{-- DASHBOARD START --}}
    <section id="wsus__dashboard">
        <div class="container-fluid">
            {{-- Sidebar --}}
            @include('vendor.layouts.sidebar')
            {{-- Sidebar End --}}

            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> All withdraw </h3>

                        {{-- Detail card sections --}}
                        <div class="wsus__dashboard">
                            <div class="row">

                                <div class=" col-md-4">
                                    <a class="wsus__dashboard_item purple" href="{{ route('vendor.orders.index') }}">
                                        <i class="fas fa-cart-plus"></i>
                                        <p>Current Balance</p>
                                        <h4 style="color: #ffff">{{ $settings->currency_icon }}{{ $currentBalance }}</h4>
                                    </a>
                                </div>

                                <div class=" col-md-4">
                                    <a class="wsus__dashboard_item purple" href="{{ route('vendor.orders.index') }}">
                                        <i class="fas fa-cart-plus"></i>
                                        <p>Pending Balance</p>
                                        <h4 style="color: #ffff"> {{ $settings->currency_icon }}{{ $pendingAmount }} </h4>
                                    </a>
                                </div>

                                <div class=" col-md-4">
                                    <a class="wsus__dashboard_item purple" href="{{ route('vendor.orders.index') }}">
                                        <i class="fas fa-cart-plus"></i>
                                        <p>Total Withdrawal</p>
                                        <h4 style="color: #ffff"> {{ $settings->currency_icon }}{{ $totalWithdraw }} </h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                        {{-- Detail card sections end --}}

                        <div class="creat_button">
                            <a href="{{ route('vendor.withdraw.create') }}" class="btn btn-primary"> <i
                                    class="fas fa-plus"></i> create product</a>
                        </div>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                {{-- Yajra data table --}}
                                {{ $dataTable->table() }}
                                {{-- Yajra data table end --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- DASHBOARD START --}}
@endsection


@push('scripts')
    {{-- Script from yajrabox --}}
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
