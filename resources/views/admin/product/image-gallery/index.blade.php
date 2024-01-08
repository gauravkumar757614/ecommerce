@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Products Image Gallery</h1>
        </div>

        <div class="mb-4">
            <a href="{{route('admin.products.index')}}" class="btn btn-primary">Back</a>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Product : {{ $product->name }} </h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.products-image-gallery.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="">Select Image <code>(multiple images supported)</code> </label>
                                    <input type="file" name="image[]" class="form-control" multiple>
                                    <input type="hidden" name="product" value="{{ $product->id }}">
                                </div>
                                <button class="btn btn-primary" type="submit">upload</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Images</h4>
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
@endpush
