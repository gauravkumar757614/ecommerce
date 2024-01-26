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
                            <h4>Edit Coupon</h4>
                        </div>
                        <div class="card-body">
                            {{-- Create Category Form --}}
                            <form action="{{ route('admin.coupons.update', $coupon->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                {{-- Name Field --}}
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ $coupon->name }}">
                                </div>
                                {{-- Name Field End --}}

                                {{-- Code Field --}}
                                <div class="form-group">
                                    <label for="">Code</label>
                                    <input type="text" class="form-control" name="code" value="{{ $coupon->code }}">
                                </div>
                                {{-- Code Field End --}}

                                {{-- Quantity Field --}}
                                <div class="form-group">
                                    <label for="">Quantity</label>
                                    <input type="text" class="form-control" name="quantity"
                                        value="{{ $coupon->quantity }}">
                                </div>
                                {{-- Quantity Field End --}}

                                {{-- Max Use Field --}}
                                <div class="form-group">
                                    <label for="">Max use per person</label>
                                    <input type="text" class="form-control" name="max_use"
                                        value="{{ $coupon->max_use }}">
                                </div>
                                {{-- Max Use Field End --}}

                                <div class="row">
                                    <div class="col-md-6">
                                        {{-- Start Date Field --}}
                                        <div class="form-group">
                                            <label for="">Start date</label>
                                            <input type="text" class="form-control datepicker" name="start_date"
                                                value="{{ $coupon->start_date }}">
                                        </div>
                                        {{-- Start Date Field End --}}
                                    </div>
                                    <div class="col-md-6">
                                        {{-- End Date Field --}}
                                        <div class="form-group">
                                            <label for="">End date</label>
                                            <input type="text" class="form-control datepicker" name="end_date"
                                                value="{{ $coupon->end_date }}">
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

                                                <option {{ $coupon->discount_type == 'percentage' ? 'selected' : '' }}
                                                    value="percentage">Percentage (%)</option>

                                                <option {{ $coupon->discount_type == 'amount' ? 'selected' : '' }}
                                                    value="amount">Amount({{ $settings->currency_icon }})</option>
                                            </select>
                                        </div>
                                        {{-- Discount Type Field End --}}
                                    </div>

                                    <div class="col-md-8">
                                        {{-- Discount Value Field --}}
                                        <div class="form-group">
                                            <label for="">Discount Value</label>
                                            <input type="text" class="form-control" name="discount"
                                                value="{{ $coupon->discount }}">
                                        </div>
                                        {{-- Discount Value Field End --}}

                                    </div>
                                </div>

                                {{-- Status Field --}}
                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select name="status" id="inputState" class="form-control">
                                        <option {{ $coupon->status == 1 ? 'selected' : '' }} value="1">Active</option>
                                        <option {{ $coupon->status == 0 ? 'selected' : '' }} value="0">Inactive
                                        </option>
                                    </select>
                                </div>
                                {{-- Status Field End --}}

                                {{-- Submit Button --}}
                                <button type="submit" class="btn btn-primary">Update</button>
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
