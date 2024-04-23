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
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> Create Variant </h3>

                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">

                                {{-- Create Category Form --}}
                                <form action="{{ route('vendor.products-variant.store') }}" method="POST">
                                    @csrf
                                    {{-- Product Id Hidden Field --}}
                                    <div class="form-group wsus_input">
                                        <input type="hidden" class="form-control" name="product"
                                            value="{{ request()->product }}">
                                    </div>
                                    {{-- Product Id Hidden Field End --}}

                                    {{-- Name Field --}}
                                    <div class="form-group wsus_input">
                                        <label for="">Name</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ old('name') }}">
                                    </div>
                                    {{-- Name Field End --}}

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
                                {{-- Create Category Form End --}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- DASHBOARD START --}}
@endsection
