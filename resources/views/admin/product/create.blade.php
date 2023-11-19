@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Product</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Product</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                {{-- Image field --}}
                                <div class="form-group">
                                    <label for="">Image</label>
                                    <input type="file" class="form-control" name="image">
                                </div>
                                {{-- Image field end --}}

                                {{-- Name field --}}
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                </div>
                                {{-- Name field end --}}

                                {{-- All category row --}}
                                <div class="row">

                                    <div class="col-md-4">
                                        {{-- Category field end --}}
                                        <div class="form-group">
                                            <label for="inputState">Category</label>
                                            <select name="category" id="inputState" class="form-control main-category">
                                                <option value="">Select</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        {{-- Category Field End --}}
                                    </div>

                                    <div class="col-md-4">
                                        {{-- Sub Category Field End --}}
                                        <div class="form-group">
                                            <label for="inputState">Sub Category</label>
                                            <select name="sub_category" id="inputState" class="form-control sub-category">

                                                <option value="">Select</option>

                                            </select>
                                        </div>
                                        {{-- Sub Category Field End --}}
                                    </div>

                                    <div class="col-md-4">
                                        {{-- Child Category Field End --}}
                                        <div class="form-group">
                                            <label for="inputState">Child Category</label>
                                            <select name="child_category" id="inputState"
                                                class="form-control child-category">

                                                <option value="">Select</option>

                                            </select>
                                        </div>
                                        {{-- Child Category Field End --}}
                                    </div>

                                </div>
                                {{-- All category row end --}}

                                {{-- Brand Field End --}}
                                <div class="form-group">
                                    <label for="inputState">Brand</label>
                                    <select name="brand" id="inputState" class="form-control child-category">

                                        <option value="">Select</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                {{-- Brand Field End --}}

                                {{-- SKU Field --}}
                                <div class="form-group">
                                    <label for="">SKU</label>
                                    <input type="text" class="form-control" name="sku" value="{{ old('sku') }}">
                                </div>
                                {{-- SKU Field End --}}

                                {{-- Price Field --}}
                                <div class="form-group">
                                    <label for="">Price</label>
                                    <input type="text" class="form-control" name="price" value="{{ old('price') }}">
                                </div>
                                {{-- Price Field End --}}

                                {{-- Offer price Field --}}
                                <div class="form-group">
                                    <label for="">Offer price</label>
                                    <input type="text" class="form-control" name="offer_price"
                                        value="{{ old('offer_price') }}">
                                </div>
                                {{-- Offer price Field End --}}

                                {{-- Date row --}}
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="">Offer Start Date</label>
                                            <input type="text" class="form-control datepicker" name="offer_start_date"
                                                value="{{ old('offer_start_date') }}">
                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="">Offer End Date</label>
                                            <input type="text" class="form-control datepicker" name="offer_end_date"
                                                value="{{ old('offer_end_date') }}">
                                        </div>

                                    </div>
                                </div>
                                {{-- Date row end --}}

                                {{-- Quantity field --}}
                                <div class="form-group">
                                    <label for="">Quantity</label>
                                    <input type="number" min="0" class="form-control" name="qty"
                                        value="{{ old('qty') }}">
                                </div>
                                {{-- Quantity field end --}}

                                {{-- Video link field --}}
                                <div class="form-group">
                                    <label for="">Video link</label>
                                    <input type="number" class="form-control" name="video_link"
                                        value="{{ old('video_link') }}">
                                </div>
                                {{-- Video link field end --}}

                                {{-- Short description field --}}
                                <div class="form-group">
                                    <label for="">Short description</label>
                                    <textarea name="short_description" id="" class="form-control"></textarea>
                                </div>
                                {{-- Short description field end --}}

                                {{-- Long description field --}}
                                <div class="form-group">
                                    <label for="">Long description</label>
                                    <textarea name="long_description" class="form-control summernote"></textarea>
                                </div>
                                {{-- Long description field end --}}

                                {{-- All boolean values fields --}}
                                <div class="row">
                                    <div class="col-md-4">
                                        {{-- Is top Field --}}
                                        <div class="form-group">
                                            <label for="inputState">Is top</label>
                                            <select name="is_top" id="inputState" class="form-control">
                                                <option value="">Select</option>
                                                <option value="">Yes</option>
                                                <option value="">No</option>
                                            </select>
                                        </div>
                                        {{-- Is top Field End --}}
                                    </div>
                                    <div class="col-md-4">
                                        {{-- Is best Field --}}
                                        <div class="form-group">
                                            <label for="inputState">Is best</label>
                                            <select name="is_best" id="inputState" class="form-control">
                                                <option value="">Select</option>
                                                <option value="">Yes</option>
                                                <option value="">No</option>
                                            </select>
                                        </div>
                                        {{-- Is best Field End --}}
                                    </div>
                                    <div class="col-md-4">
                                        {{-- Is featured Field --}}
                                        <div class="form-group">
                                            <label for="inputState">Is featured</label>
                                            <select name="is_featured" id="inputState" class="form-control">
                                                <option value="">Select</option>
                                                <option value="">Yes</option>
                                                <option value="">No</option>
                                            </select>
                                        </div>
                                        {{-- Is featured Field End --}}
                                    </div>
                                </div>
                                {{-- All boolean values fields end --}}






                                {{-- Status Field --}}
                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select name="status" id="inputState" class="form-control">
                                        <option value="">Select</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                {{-- Status Field End --}}

                                <button class="btn btn-primary" type="submit">Create</button>
                            </form>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection


{{-- This script will call all the related sub category for the selected main category in the sub category select option --}}
@push('scripts')
    <script>
        $(document).ready(function() {
            $('body').on('change', '.main-category', function(e) {
                let id = $(this).val();

                // Ajax code fetching records dynamically from sub category model
                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.product.get-subcategories') }}",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        // the following line remove all the previous data
                        $('.sub-category').html('<option value="">Select</option>')

                        $.each(data, function(i, item) {
                            // showing the sub categories for the selected main category
                            $('.sub-category').append(
                                `<option value="${item.id}">${item.name}</option>`
                            )
                        })
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }

                })
                // Ajax End
            })

            // After category when sub category is selected following code will fetch all the child categories
            $('body').on('change', '.sub-category', function(e) {
                let id = $(this).val();

                // Ajax code fetching records dynamically from sub category model
                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.product.get-child-categories') }}",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        // the following line remove all the previous data
                        $('.child-category').html('<option value="">Select</option>')

                        $.each(data, function(i, item) {
                            // showing the child categories for the selected main category
                            $('.child-category').append(
                                `<option value="${item.id}">${item.name}</option>`
                            )
                        })
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }

                })
                // Ajax End
            })
        })
    </script>
@endpush
