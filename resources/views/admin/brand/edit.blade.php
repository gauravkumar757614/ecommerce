@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Brand</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Brand</h4>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('admin.brand.update', $brand->id) }}" method="POST"
                                enctype="multipart/form-data">

                                @csrf
                                @method('PUT')

                                {{-- Preview Image Field --}}
                                <div class="form-group">
                                    <label for="">Preview</label>
                                    <br>
                                    <img src="{{ asset($brand->logo) }}" alt="brand_image" srcset="" width="200">
                                </div>
                                {{-- Preview Image Field End --}}

                                {{-- Image Field --}}
                                <div class="form-group">
                                    <label for="">Logo</label>
                                    <input type="file" class="form-control" name="logo">
                                </div>
                                {{-- Image Field End --}}

                                {{-- Name Field --}}
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ $brand->name }}">
                                </div>
                                {{-- Name Field End --}}

                                {{-- Featured Field End --}}
                                <div class="form-group">
                                    <label for="inputState">Is Featured</label>
                                    <select name="is_featured" id="inputState" class="form-control">
                                        <option value="">Select</option>
                                        <option {{ $brand->is_featured == 1 ? 'selected' : '' }} value="1">Yes</option>
                                        <option {{ $brand->is_featured == 0 ? 'selected' : '' }} value="0">No</option>
                                    </select>
                                </div>
                                {{-- Featured Field End --}}

                                {{-- Status Field --}}
                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select name="status" id="inputState" class="form-control">
                                        <option {{ $brand->status == 1 ? 'selected' : '' }} value="1">Active
                                        </option>
                                        <option {{ $brand->status == 1 ? 'selected' : '' }} value="0">Inactive
                                        </option>
                                    </select>
                                </div>
                                {{-- Status Field End --}}

                                <button class="btn btn-primary" type="submit">Update</button>
                            </form>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
