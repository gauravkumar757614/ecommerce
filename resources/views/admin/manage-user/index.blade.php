@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage User</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create user</h4>
                        </div>
                        <div class="card-body">
                            {{-- Create Category Form --}}
                            <form action="{{ route('admin.manage-user.create') }}" method="POST">
                                @csrf

                                {{-- Name Field --}}
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                </div>
                                {{-- Name Field End --}}

                                {{-- Email Field --}}
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                                </div>
                                {{-- Email Field End --}}

                                <div class="row">
                                    <div class="col-md-6">
                                        {{-- Password Field --}}
                                        <div class="form-group">
                                            <label for="">Password</label>
                                            <input type="password" class="form-control" name="password"
                                                value="{{ old('password') }}">
                                        </div>
                                        {{-- Password Field End --}}
                                    </div>
                                    <div class="col-md-6">
                                        {{-- Confirm Password Field --}}
                                        <div class="form-group">
                                            <label for="">Confirm Password</label>
                                            <input type="password" class="form-control" name="password_confirmation"
                                                value="{{ old('confirm_password') }}">
                                        </div>
                                        {{-- Confirm Password Field End --}}
                                    </div>
                                </div>

                                {{-- Status Field End --}}
                                <div class="form-group">
                                    <label for="inputState">Role</label>
                                    <select name="role" id="inputState" class="form-control">
                                        <option value="">Select</option>
                                        <option value="user">User</option>
                                        <option value="vendor">Vendor</option>
                                        <option value="admin">Admin</option>
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
