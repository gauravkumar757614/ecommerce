@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Child Category</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Child Categories</h4>
                        </div>
                        <div class="card-body">
                            {{-- Create Category Form --}}
                            <form action="{{ route('admin.child-category.store') }}" method="POST">
                                @csrf

                                {{-- Select Category Id Field --}}
                                <div class="form-group">
                                    <label for="inputState">Category</label>
                                    {{-- Added A Class Main-Category If Selected It will Fetch All Sub Category --}}
                                    <select id="inputState" class="form-control main-category" name="category">
                                        <option value="">Select</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- Select Category Id Field End --}}

                                {{-- Select Sub Category Id Field --}}
                                <div class="form-group">
                                    <label for="inputState">Sub Category</label>
                                    <select id="inputState" class="form-control sub-category" name="sub_category">
                                        <option value="">Select</option>
                                    </select>
                                </div>
                                {{-- Select Sub Category Id Field End --}}

                                {{-- Name Field --}}
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                </div>
                                {{-- Name Field End --}}

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
    <script>
        $(document).ready(function() {
            $('body').on('change', '.main-category', function(e) {
                let id = $(this).val();

                // Ajax code fetching records dynamically from sub category model
                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.get-subcategories') }}",
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
        })
    </script>
@endpush
