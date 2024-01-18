@extends('vendor.layouts.master');

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

                        <div class="m-2 ">
                            <a href="{{ route('vendor.products.index') }}" class="btn btn-warning"> <i
                                    class="fas fa-backward"></i> Back </a>
                        </div>

                        <h3><i class="fas fa-images"></i> Products {{ $product->name }} </h3>

                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">

                                <form action="{{ route('vendor.products-image-gallery.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group wsus_input">
                                        <label for="">Select Image <code>(multiple images supported)</code> </label>
                                        <input type="file" name="image[]" class="form-control" multiple>
                                        <input type="hidden" name="product" value="{{ $product->id }}">
                                    </div>
                                    <button class="btn btn-primary" type="submit">upload</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="fas fa-images"></i> Products Image </h3>

                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">

                                {{ $dataTable->table() }}

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
