@php
    $productSliderThree = json_decode($productSliderSectionThree->value, true);
    // @dd($productSliderThree);
@endphp
<div class="tab-pane fade" id="slider-section-three" role="tabpanel" aria-labelledby="list-settings-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.product-slider-section-three.update') }}" method="POST">
                @csrf
                @method('PUT')
                <h5>Part 1</h5>
                <div class="row">
                    {{-- Category 1 --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Category</label>
                            <select name="cat_one" id="" class="form-control main-category">
                                <option value="">Select</option>
                                @foreach ($categories as $category)
                                    <option {{ $category->id == $productSliderThree[0]['category'] ? 'selected' : '' }}
                                        value="{{ $category->id }}"> {{ $category->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Sub Category 1 --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            @php
                                $subCategories = \App\Models\SubCategory::where(
                                    'category_id',
                                    $productSliderThree[0]['category'],
                                )->get();
                            @endphp
                            <label for="">Sub Category </label>
                            <select name="sub_cat_one" id="" class="form-control sub-category">
                                <option value="">Select</option>
                                @foreach ($subCategories as $subCategory)
                                    <option
                                        {{ $subCategory->id == $productSliderThree[0]['sub_category'] ? 'selected' : '' }}
                                        value="{{ $subCategory->id }}">
                                        {{ $subCategory->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Child Category 1 --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            @php
                                $childCategories = \App\Models\ChildCategory::where(
                                    'sub_category_id',
                                    $productSliderThree[0]['sub_category'],
                                )->get();
                            @endphp
                            <label for="">child Category </label>
                            <select name="child_cat_one" id="" class="form-control child-category">
                                <option value="">Select</option>
                                @foreach ($childCategories as $childCategory)
                                    <option
                                        {{ $childCategory->id == $productSliderThree[0]['child_category'] ? 'selected' : '' }}
                                        value="{{ $childCategory->id }}">
                                        {{ $childCategory->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>

                <h5>Part 2</h5>
                <div class="row">
                    {{-- Category 1 --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Category</label>
                            <select name="cat_two" id="" class="form-control main-category">
                                <option value="">Select</option>
                                @foreach ($categories as $category)
                                    <option {{ $category->id == $productSliderThree[1]['category'] ? 'selected' : '' }}
                                        value="{{ $category->id }}"> {{ $category->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Sub Category 1 --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            @php
                                $subCategories = \App\Models\SubCategory::where(
                                    'category_id',
                                    $productSliderThree[1]['category'],
                                )->get();
                            @endphp
                            <label for="">Sub Category </label>
                            <select name="sub_cat_two" id="" class="form-control sub-category">
                                <option value="">Select</option>
                                @foreach ($subCategories as $subCategory)
                                    <option
                                        {{ $subCategory->id == $productSliderThree[1]['sub_category'] ? 'selected' : '' }}
                                        value="{{ $subCategory->id }}">
                                        {{ $subCategory->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Child Category 1 --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            @php
                                $childCategories = \App\Models\ChildCategory::where(
                                    'sub_category_id',
                                    $productSliderThree[1]['sub_category'],
                                )->get();
                            @endphp
                            <label for="">child Category </label>
                            <select name="child_cat_two" id="" class="form-control child-category">
                                <option value="">Select</option>
                                @foreach ($childCategories as $childCategory)
                                    <option
                                        {{ $childCategory->id == $productSliderThree[1]['child_category'] ? 'selected' : '' }}
                                        value="{{ $childCategory->id }}">
                                        {{ $childCategory->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
                <button type="submit" class="btn btn-primary"> update </button>
            </form>

        </div>
    </div>
</div>

{{-- This script will call all the related sub category for the selected main category in the sub category select option --}}
@push('scripts')
    <script>
        $(document).ready(function() {
            $('body').on('change', '.main-category', function(e) {
                let id = $(this).val();
                let row = $(this).closest('.row');
                // Ajax code fetching records dynamically from sub category model
                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.get-subcategories') }}",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        let selector = row.find('.sub-category');
                        // the following line remove all the previous data
                        selector.html('<option value="">Select</option>')

                        $.each(data, function(i, item) {
                            // showing the sub categories for the selected main category
                            selector.append(
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

            $('body').on('change', '.sub-category', function(e) {
                let id = $(this).val();
                let row = $(this).closest('.row');
                // Ajax code fetching records dynamically from sub category model
                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.product.get-child-categories') }}",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        let selector = row.find('.child-category');
                        // the following line remove all the previous data
                        selector.html('<option value="">Select</option>')

                        $.each(data, function(i, item) {
                            // showing the child categories for the selected main category
                            selector.append(
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
