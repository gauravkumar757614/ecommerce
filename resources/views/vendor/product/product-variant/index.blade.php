@extends('vendor.layouts.master')

@section('title')
    {{ $settings->site_name }} || Product-Variant
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

                    <div class="m-2 ">
                        <a href="{{ route('vendor.products.index') }}" class="btn btn-warning"> <i class="fas fa-backward"></i>
                            Back </a>
                    </div>

                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> Products Variant </h3>
                        <h6> Products {{ $product->name }} </h6>
                        <div class="creat_button">
                            <a href="{{ route('vendor.products-variant.create', ['product' => $product->id]) }}"
                                class="btn btn-primary"> <i class="fas fa-plus"></i> create new </a>
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

    <script>
        $(document).ready(function() {
            $('body').on('click', '.change-status', function() {
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                $.ajax({
                    url: "{{ route('vendor.products-variant.change-status') }}",
                    method: 'PUT',
                    data: {
                        status: isChecked,
                        id: id
                    },
                    success: function(data) {
                        toastr.success(data.message)
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }

                })
            })
        })
    </script>
@endpush
