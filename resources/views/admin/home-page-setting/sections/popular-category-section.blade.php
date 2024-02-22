<div class="tab-pane show active fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
    <form action="" method="POST">
        @csrf
        @method('PUT')
        <h5>Category 1</h5>
        <div class="row">
            {{-- Category --}}
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Category</label>
                    <select name="cat_one" id="" class="form-control main-category">
                        <option value="">Select</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"> {{ $category->name }} </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Sub Category --}}
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Sub Category </label>
                    <select name="sub_cat_one" id="" class="form-control sub-category">
                        <option value="">Select</option>
                    </select>
                </div>
            </div>

            {{-- Child Category --}}
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">child Category </label>
                    <select name="child_cat_one" id="" class="form-control child-category">
                        <option value="">Select</option>
                    </select>
                </div>
            </div>

        </div>

        <h5>Category 2</h5>
        <div class="row">
            {{-- Category --}}
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Category</label>
                    <select name="cat_two" id="" class="form-control main-category">
                        <option value="">Select</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"> {{ $category->name }} </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Sub Category --}}
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Sub Category </label>
                    <select name="sub_cat_two" id="" class="form-control sub-category">
                        <option value="">Select</option>
                    </select>
                </div>
            </div>

            {{-- Child Category --}}
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">child Category </label>
                    <select name="child_cat_two" id="" class="form-control child-category">
                        <option value="">Select</option>
                    </select>
                </div>
            </div>

        </div>

        <h5>Category 3</h5>
        <div class="row">
            {{-- Category --}}
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Category</label>
                    <select name="cat_three" id="" class="form-control main-category">
                        <option value="">Select</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"> {{ $category->name }} </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Sub Category --}}
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Sub Category </label>
                    <select name="sub_cat_three" id="" class="form-control sub-category">
                        <option value="">Select</option>
                    </select>
                </div>
            </div>

            {{-- Child Category --}}
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">child Category </label>
                    <select name="child_cat_three" id="" class="form-control child-category">
                        <option value="">Select</option>
                    </select>
                </div>
            </div>

        </div>

        <h5>Category 4</h5>
        <div class="row">
            {{-- Category --}}
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Category</label>
                    <select name="cat_four" id="" class="form-control main-category">
                        <option value="">Select</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"> {{ $category->name }} </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Sub Category --}}
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Sub Category </label>
                    <select name="sub_cat_four" id="" class="form-control sub-category">
                        <option value="">Select</option>
                    </select>
                </div>
            </div>

            {{-- Child Category --}}
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">child Category </label>
                    <select name="child_cat_four" id="" class="form-control child-category">
                        <option value="">Select</option>
                    </select>
                </div>
            </div>

        </div>

        <button type="submit" class="btn btn-primary"> update </button>
    </form>

</div>



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
