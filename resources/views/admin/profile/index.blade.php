@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Profile</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Profile</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-7">
                    {{-- First Card For UserName and Email Fields --}}
                    <div class="card">

                        <form method="post" class="needs-validation" novalidate=""
                            action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="card-header">
                                <h4>Update Profile</h4>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    {{-- Upload Image Field --}}
                                    <div class="form-group col-12">
                                        <img src="{{ Auth::user()->image }}" alt="admin image" width="150">
                                        <p>Preview image</p>
                                        <br>
                                        <label for="image">Upload Image</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                    {{-- Upload Image Field End --}}

                                    {{-- Update Name Field --}}
                                    <div class="form-group col-md-6 col-12">
                                        <label> Name </label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ Auth::user()->name }}">
                                    </div>
                                    {{-- Update Name Field End --}}

                                    {{-- Update Email Field --}}
                                    <div class="form-group col-md-6 col-12">
                                        <label> Email </label>
                                        <input type="email" class="form-control" name="email"
                                            value="{{ Auth::user()->email }}">
                                    </div>
                                    {{-- Update Email Field End --}}

                                </div>
                            </div>

                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Save Changes</button>
                            </div>

                        </form>

                    </div>
                    {{-- First Car For UserName and Email Fields Ends --}}

                    {{-- Second Card For Password Change --}}
                    <div class="card">

                        <form method="post" class="needs-validation" novalidate=""
                            action="{{ route('admin.password.update') }}">
                            @csrf

                            <div class="card-header">
                                <h4>Update Password</h4>
                            </div>

                            <div class="card-body">
                                <div class="row">

                                    {{-- Change Password Field --}}
                                    <div class="form-group col-12">
                                        <label> Current Password </label>
                                        <input type="password" class="form-control" name="current_password">
                                        @if ($errors->has('current_password'))
                                            <code> {{ $errors->first('current_password') }} </code>
                                        @endif
                                    </div>

                                    <div class="form-group col-12">
                                        <label> New Password </label>
                                        <input type="password" class="form-control" name="password">
                                        @if ($errors->has('password'))
                                            <code> {{ $errors->first('password') }} </code>
                                        @endif
                                    </div>

                                    <div class="form-group col-12">
                                        <label> Confirm Password </label>
                                        <input type="password" class="form-control" name="password_confirmation">
                                        @if ($errors->has('password_confirmation'))
                                            <code> {{ $errors->first('password_confirmation') }} </code>
                                        @endif
                                    </div>
                                    {{-- Change Password Field End --}}

                                </div>
                            </div>

                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Update Password</button>
                            </div>

                        </form>

                    </div>
                    {{-- Second Card For Password Change End --}}

                </div>
            </div>
        </div>
    </section>
@endsection
