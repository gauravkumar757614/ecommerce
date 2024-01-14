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
                            <h4>Create Variant Item</h4>
                        </div>
                        <div class="card-body">
                            {{-- Create Category Form --}}
                            <form action="{{ route('admin.products-variant-item.store') }}" method="POST">
                                @csrf
                                {{-- Product Id Hidden Field --}}
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="product" value="{{ $product->id }}">
                                </div>
                                {{-- Product Id Hidden Field End --}}

                                {{-- Product Variant Id Hidden Field --}}
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="variant_id"
                                        value="{{ $variant->id }}">
                                </div>
                                {{-- Product Variant Id Hidden Field End --}}

                                {{-- Varing Name Field --}}
                                <div class="form-group">
                                    <label for="">Variant Name</label>
                                    <input type="text" class="form-control" name="variant_name"
                                        value="{{ $variant->name }}" readonly>
                                </div>
                                {{-- Varing Name Field End --}}

                                {{-- Item Name Field --}}
                                <div class="form-group">
                                    <label for="">Item Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('') }}">
                                </div>
                                {{-- Item Name Field End --}}

                                {{-- Price Field --}}
                                <div class="form-group">
                                    <label for="">Price <code>(set 0 for make it free)</code></label>
                                    <input type="text" class="form-control" name="price" value="{{ old('') }}">
                                </div>
                                {{-- Price Field End --}}

                                {{-- Is Default Field --}}
                                <div class="form-group">
                                    <label for="inputState">Is Default</label>
                                    <select name="is_default" id="inputState" class="form-control">
                                        <option value="">Select</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                {{-- Is Default Field End --}}

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
