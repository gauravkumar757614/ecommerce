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
                            <h4>Edit Footer Socials</h4>
                        </div>
                        <div class="card-body">
                            {{-- Create Category Form --}}
                            <form action="{{ route('admin.footer-socials.update', $footerSocial->id) }}" method="POST">
                                @csrf
                                @method('put')
                                {{-- Icon Picker Button --}}
                                <div class="form-group">
                                    <label for="">Icon</label>
                                    <div>
                                        <button name="icon" class="btn btn-primary" data-icon="{{$footerSocial->icon}}" role="iconpicker"
                                            data-selected-class="btn-danger" data-unselected-class="btn-info">
                                        </button>
                                    </div>
                                </div>
                                {{-- Icon Picker Button End --}}

                                {{-- Name Field --}}
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ $footerSocial->name }}">
                                </div>
                                {{-- Name Field End --}}

                                {{-- Url Field --}}
                                <div class="form-group">
                                    <label for="">Url</label>
                                    <input type="text" class="form-control" name="url"
                                        value="{{ $footerSocial->url }}">
                                </div>
                                {{-- Url Field End --}}

                                {{-- Status Field End --}}
                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select name="status" id="inputState" class="form-control">
                                        <option {{ $footerSocial->status == 1 ? 'active' : '' }} value="1">Active
                                        </option>
                                        <option {{ $footerSocial->status == 0 ? 'active' : '' }} value="0">Inactive
                                        </option>
                                    </select>
                                </div>
                                {{-- Status Field End --}}

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
