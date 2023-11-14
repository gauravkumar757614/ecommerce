@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Vendor Profile</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Vendor Profile</h4>
                        </div>

                        <div class="card-body">

                            <form action="{{ route('admin.vendor-profile.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                {{-- Image Field --}}
                                <div class="form-group">
                                    <label for="">Banner</label>
                                    <input type="file" class="form-control" name="banner">
                                </div>
                                {{-- Image Field End --}}

                                {{-- Phone Field --}}
                                <div class="form-group">
                                    <label for="">Phone</label>
                                    <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">
                                </div>
                                {{-- Phone Field End --}}

                                {{-- Email Field --}}
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                </div>
                                {{-- Email Field End --}}

                                {{-- Address Field --}}
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <input type="text" class="form-control" name="address" value="{{ old('address') }}">
                                </div>
                                {{-- Address Field End --}}

                                {{-- Description Field --}}
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea name="description" class="summernote"></textarea>
                                </div>
                                {{-- Description Field End --}}

                                {{-- Facebook link Field --}}
                                <div class="form-group">
                                    <label for="">Facebook</label>
                                    <input type="text" class="form-control" name="fb_link" value="{{ old('fb_link') }}">
                                </div>
                                {{-- Facebook link Field End --}}

                                {{-- Twitter link Field --}}
                                <div class="form-group">
                                    <label for="">Twitter</label>
                                    <input type="text" class="form-control" name="tw_link" value="{{ old('tw_link') }}">
                                </div>
                                {{-- Twitter link Field End --}}

                                {{-- Instagram link Field --}}
                                <div class="form-group">
                                    <label for="">Instagram</label>
                                    <input type="text" class="form-control" name="insta_link"
                                        value="{{ old('insta_link') }}">
                                </div>
                                {{-- Instagram link Field End --}}

                                <button class="btn btn-primary" type="submit">Update</button>
                            </form>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
