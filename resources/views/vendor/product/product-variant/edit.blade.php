@extends('vendor.layouts.master');

@section('title')
    {{ $settings->site_name }} || Product-Variant
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

                    <div class="m-2 ">
                        <a href="{{ route('vendor.products-variant.index', ['product' => $variant->product_id]) }}"
                            class="btn btn-warning"> <i class="fas fa-backward"></i>
                            Back </a>
                    </div>


                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> Edit Variant </h3>

                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">

                                {{-- Update Variant Form --}}
                                <form action="{{ route('vendor.products-variant.update', $variant->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    {{-- Name Field --}}
                                    <div class="form-group wsus_input">
                                        <label for="">Name</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ $variant->name }}">
                                    </div>
                                    {{-- Name Field End --}}

                                    {{-- Status Field --}}
                                    <div class="form-group wsus_input">
                                        <label for="inputState">Status</label>
                                        <select name="status" id="inputState" class="form-control">
                                            <option {{ $variant->status == 1 ? 'selected' : '' }} value="1">Active
                                            </option>
                                            <option {{ $variant->status == 0 ? 'selected' : '' }} value="0">Inactive
                                            </option>
                                        </select>
                                    </div>
                                    {{-- Status Field End --}}

                                    {{-- Submit Button --}}
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    {{-- Submit Button End --}}
                                </form>
                                {{-- Update Variant Form End --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- DASHBOARD START --}}
@endsection