@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Product Variant Item</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Variant Item</h4>
                        </div>
                        <div class="card-body">
                            {{-- Update Product Variant Item Form --}}
                            <form action="{{ route('admin.products-variant-item.update', $variant_item->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                {{-- Varing Name Field --}}
                                <div class="form-group">
                                    <label for="">Variant Name</label>
                                    <input type="text" class="form-control" name="variant_name"
                                        value="{{ $variant_item->productVariant->name }}" readonly>
                                </div>
                                {{-- Varing Name Field End --}}

                                {{-- Item Name Field --}}
                                <div class="form-group">
                                    <label for="">Item Name</label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ $variant_item->name }}">
                                </div>
                                {{-- Item Name Field End --}}

                                {{-- Price Field --}}
                                <div class="form-group">
                                    <label for="">Price <code>(set 0 for make it free)</code></label>
                                    <input type="text" class="form-control" name="price"
                                        value="{{ $variant_item->price }}">
                                </div>
                                {{-- Price Field End --}}

                                {{-- Is Default Field --}}
                                <div class="form-group">
                                    <label for="inputState">Is Default</label>
                                    <select name="is_default" id="inputState" class="form-control">
                                        <option value="">Select</option>
                                        <option {{ $variant_item->is_default == 1 ? 'selected' : '' }} value="1">Yes
                                        </option>
                                        <option {{ $variant_item->is_default == 0 ? 'selected' : '' }} value="0">No
                                        </option>
                                    </select>
                                </div>
                                {{-- Is Default Field End --}}

                                {{-- Status Field --}}
                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select name="status" id="inputState" class="form-control">
                                        <option {{ $variant_item->is_default == 1 ? 'selected' : '' }} value="1">Active
                                        </option>
                                        <option {{ $variant_item->is_default == 0 ? 'selected' : '' }} value="0">
                                            Inactive</option>
                                    </select>
                                </div>
                                {{-- Status Field End --}}

                                {{-- Submit Button --}}
                                <button type="submit" class="btn btn-primary">Update</button>
                                {{-- Submit Button End --}}
                            </form>
                            {{-- Product Product Variant Item Form End --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
