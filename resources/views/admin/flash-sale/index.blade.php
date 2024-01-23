@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Flash Sale</h1>
        </div>
        {{-- Flash Sale End Date --}}
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Flash End Date</h4>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('admin.flash-sale.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Sale End Date</label>
                                        <input type="text" class="form-control datepicker" name="end_date"
                                            value="{{ $saleDate->end_date }}">
                                    </div>
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        {{-- Add Flash Sale Products --}}
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Add Flash Sale Products</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.flash-sale.add-product') }}" method="POST">
                                @csrf
                                {{-- Add product --}}
                                <div class="form-group">
                                    <label for="add-product">Add Product</label>
                                    <select name="product" id="add-product" class="form-control select2">
                                        <option value="">Select</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}"> {{ $product->name }} </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        {{-- Show at home drop down --}}
                                        <div class="form-group">
                                            <label for="inputState">Show at home</label>
                                            <select name="show_at_home" id="inputState" class="form-control">
                                                <option value="">Select</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        {{-- Status --}}
                                        <div class="form-group">
                                            <label for="inputState">Status</label>
                                            <select name="status" id="inputState" class="form-control">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Save</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- All Flash Sale Products --}}
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Flash Sale Products</h4>
                        </div>
                        <div class="card-body">
                            {{-- Yajrabox table data --}}
                            {{ $dataTable->table() }}
                            {{-- Yajrabox table data End --}}
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection

@push('scripts')
    {{-- Script from yajrabox --}}
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        $(document).ready(function() {
            // change status
            $('body').on('click', '.change-status', function() {
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                $.ajax({
                    url: "{{ route('admin.flash-sale-status') }}",
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
            // change show at home
            $('body').on('click', '.change-at-home-status', function() {
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                $.ajax({
                    url: "{{ route('admin.flash-sale.show-at-home.change-status') }}",
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
