@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Blog </h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit blog</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.blog.update', $blog->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')



                                {{-- Preview Image field --}}
                                <div class="form-group">
                                    <img src="{{ asset($blog->image) }}" alt="blog image" width="150">
                                    <br>
                                    <label for="">Preview Image</label>
                                </div>
                                {{-- Preview Image field end --}}

                                {{-- Image field --}}
                                <div class="form-group">
                                    <label for="">Image</label>
                                    <input type="file" class="form-control" name="image">
                                </div>
                                {{-- Image field end --}}

                                {{-- Name field --}}
                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input type="text" class="form-control" name="title" value="{{ $blog->title }}">
                                </div>
                                {{-- Name field end --}}

                                {{-- Category field end --}}
                                <div class="form-group">
                                    <label for="inputState">Category</label>
                                    <select name="category_id" id="inputState" class="form-control main-category">
                                        <option value="">Select</option>
                                        @foreach ($categories as $category)
                                            <option {{ $blog->blog_category_id == $category->id ? 'selected' : '' }}
                                                value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- Category Field End --}}

                                {{-- Long description field --}}
                                <div class="form-group">
                                    <label for=""> Description</label>
                                    <textarea name="description" class="form-control summernote"> {{ $blog->description }} </textarea>
                                </div>
                                {{-- Long description field end --}}

                                {{-- Seo title field --}}
                                <div class="form-group">
                                    <label for="">Seo title</label>
                                    <input type="text" class="form-control" name="seo_title"
                                        value="{{ $blog->seo_title }}">
                                </div>
                                {{-- Seo title field end --}}

                                {{-- Seo description field --}}
                                <div class="form-group">
                                    <label for="">Seo description</label>
                                    <textarea name="seo_description" id="" class="form-control"> {{ $blog->seo_description }} </textarea>
                                </div>
                                {{-- Seo description field end --}}

                                {{-- Status Field --}}
                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select name="status" id="inputState" class="form-control">
                                        <option {{ $blog->status == 1 ? 'selected' : '' }} value="1">Active</option>
                                        <option {{ $blog->status == 0 ? 'selected' : '' }} value="0">Inactive</option>
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
@endpush
