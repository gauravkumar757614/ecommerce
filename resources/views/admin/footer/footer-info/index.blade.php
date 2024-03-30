@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Footer</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Footer Info</h4>
                        </div>
                        <div class="card-body">
                            {{-- Create Category Form --}}
                            <form action="{{ route('admin.footer-info.update', 1) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                {{-- Logo Field --}}
                                <div class="form-group">
                                    <img src="{{ asset(@$footerInfo->logo) }}" width="150px" alt="ecommerce logo" />
                                    <br>
                                    <label for="">Footer Logo</label>
                                    <input type="file" class="form-control" name="logo">
                                </div>
                                {{-- Logo Field End --}}

                                <div class="row">
                                    <div class="col-md-6">
                                        {{-- Name Field --}}
                                        <div class="form-group">
                                            <label for="">Phone</label>
                                            <input type="text" class="form-control" name="phone"
                                                value="{{ @$footerInfo->phone }}">
                                        </div>
                                        {{-- Name Field End --}}
                                    </div>
                                    <div class="col-md-6">
                                        {{-- Email Field --}}
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="email" class="form-control" name="email"
                                                value="{{ @$footerInfo->email }}">
                                        </div>
                                        {{-- Email Field End --}}
                                    </div>
                                </div>

                                {{-- Address Field --}}
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <input type="text" class="form-control" name="address"
                                        value="{{ @$footerInfo->address }}">
                                </div>
                                {{-- Address Field End --}}

                                {{-- Copywrite Field --}}
                                <div class="form-group">
                                    <label for="">Copywrite</label>
                                    <input type="text" class="form-control" name="copywrite"
                                        value="{{ @$footerInfo->copywrite }}">
                                </div>
                                {{-- Copywrite Field End --}}

                                {{-- Submit Button --}}
                                <button type="submit" class="btn btn-primary">Update</button>
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
