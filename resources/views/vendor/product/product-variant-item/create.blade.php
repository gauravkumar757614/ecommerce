@extends('vendor.layouts.master');

@section('title')
    {{ $settings->site_name }} || Product-Variant-Item
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
                    <div class="mb-4">
                        <a href="{{ route('vendor.products-variant-item.index', ['productId' => $product->id, 'variantId' => $variant->id]) }}"
                            class="btn btn-warning">Back</a>
                    </div>
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> Variant Item</h3>
                        <h6 class="mb-3">Variant {{ $variant->name }}</h6>

                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">

                                {{-- Create Product Variant Item Form --}}
                                <form action="{{ route('vendor.products-variant-item.store') }}" method="POST">
                                    @csrf
                                    {{-- Product Id Hidden Field --}}
                                    <div class="form-group wsus_input">
                                        <input type="hidden" class="form-control" name="product"
                                            value="{{ $product->id }}">
                                    </div>
                                    {{-- Product Id Hidden Field End --}}

                                    {{-- Product Variant Id Hidden Field --}}
                                    <div class="form-group wsus_input">
                                        <input type="hidden" class="form-control" name="variant_id"
                                            value="{{ $variant->id }}">
                                    </div>
                                    {{-- Product Variant Id Hidden Field End --}}

                                    {{-- Varing Name Field --}}
                                    <div class="form-group wsus_input">
                                        <label for="">Variant Name</label>
                                        <input type="text" class="form-control" name="variant_name"
                                            value="{{ $variant->name }}" readonly>
                                    </div>
                                    {{-- Varing Name Field End --}}

                                    {{-- Item Name Field --}}
                                    <div class="form-group wsus_input">
                                        <label for="">Item Name</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ old('') }}">
                                    </div>
                                    {{-- Item Name Field End --}}

                                    {{-- Price Field --}}
                                    <div class="form-group wsus_input">
                                        <label for="">Price <code>(set 0 for make it free)</code></label>
                                        <input type="text" class="form-control" name="price"
                                            value="{{ old('') }}">
                                    </div>
                                    {{-- Price Field End --}}

                                    {{-- Is Default Field --}}
                                    <div class="form-group wsus_input">
                                        <label for="inputState">Is Default</label>
                                        <select name="is_default" id="inputState" class="form-control">
                                            <option value="">Select</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                    {{-- Is Default Field End --}}

                                    {{-- Status Field --}}
                                    <div class="form-group wsus_input">
                                        <label for="inputState">Status</label>
                                        <select name="status" id="inputState" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                    {{-- Status Field End --}}

                                    {{-- Submit Button --}}
                                    <button type="submit" class="btn btn-primary">Create</button>
                                    {{-- Submit Button End --}}
                                </form>
                                {{-- Create Product Variant Item Form End --}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- DASHBOARD START --}}
@endsection