@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Coupon</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Coupon</h4>
                        </div>
                        <div class="card-body">
                            {{-- Create Category Form --}}
                            <form action="{{ route('admin.coupons.store') }}" method="POST">
                                @csrf

                                {{-- Name Field --}}
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                </div>
                                {{-- Name Field End --}}

                                {{-- Code Field --}}
                                <div class="form-group">
                                    <label for="">Code</label>
                                    <input type="text" class="form-control" name="code" value="{{ old('code') }}">
                                </div>
                                {{-- Code Field End --}}

                                {{-- Quantity Field --}}
                                <div class="form-group">
                                    <label for="">Quantity</label>
                                    <input type="text" class="form-control" name="quantity"
                                        value="{{ old('quantity') }}">
                                </div>
                                {{-- Quantity Field End --}}

                                {{-- Max Use Field --}}
                                <div class="form-group">
                                    <label for="">Max use per person</label>
                                    <input type="text" class="form-control" name="max_use" value="{{ old('max_use') }}">
                                </div>
                                {{-- Max Use Field End --}}

                                <div class="row">
                                    <div class="col-md-6">
                                        {{-- Start Date Field --}}
                                        <div class="form-group">
                                            <label for="">Start date</label>
                                            <input type="text" class="form-control datepicker" name="start_date"
                                                value="{{ old('start_date') }}">
                                        </div>
                                        {{-- Start Date Field End --}}
                                    </div>
                                    <div class="col-md-6">
                                        {{-- End Date Field --}}
                                        <div class="form-group">
                                            <label for="">End date</label>
                                            <input type="text" class="form-control datepicker" name="end_date"
                                                value="{{ old('end_date') }}">
                                        </div>
                                        {{-- End Date Field End --}}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        {{-- Discount Type Field --}}
                                        <div class="form-group">
                                            <label for="inputState">Discount type</label>
                                            {{-- Added A Class Main-Category If Selected It will Fetch All Sub Category --}}
                                            <select id="inputState" class="form-control main-category" name="discount_type">
                                                <option value="percentage">Percentage (%)</option>
                                                <option value="amount">Amount({{ $settings->currency_icon }})</option>
                                            </select>
                                        </div>
                                        {{-- Discount Type Field End --}}
                                    </div>

                                    <div class="col-md-8">
                                        {{-- Discount Value Field --}}
                                        <div class="form-group">
                                            <label for="">Discount Value</label>
                                            <input type="text" class="form-control" name="discount"
                                                value="{{ old('end_date') }}">
                                        </div>
                                        {{-- Discount Value Field End --}}

                                    </div>
                                </div>

                                {{-- Status Field --}}
                                <div class="form-group">
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
    </section>
@endsection

{{-- This script will call all the related sub category for the selected main category in the sub category select option --}}
@push('scripts')
@endpush
