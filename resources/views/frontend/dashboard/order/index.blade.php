@extends('frontend.dashboard.layouts.master')

@section('title')
    {{ $settings->site_name }} || Order
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
                        <h3><i class="far fa-user"></i> Orders </h3>

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
