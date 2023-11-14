@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Slider</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Slider</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                {{-- Image Field --}}
                                <div class="form-group">
                                    <label for="">Type</label>
                                    <input type="file" class="form-control" name="banner">
                                </div>
                                {{-- Image Field End --}}

                                {{-- Type Field --}}
                                <div class="form-group">
                                    <label for="">Type</label>
                                    <input type="text" class="form-control" name="type" value="{{old('type')}}">
                                </div>
                                {{-- Type Field End --}}

                                {{-- Title Field --}}
                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input type="text" class="form-control" name="title" value="{{old('title')}}">
                                </div>
                                {{-- Title Field End --}}

                                {{-- STarting Price Field --}}
                                <div class="form-group">
                                    <label for="">Starting price</label>
                                    <input type="text" class="form-control" name="starting_price" value="{{old('starting_price')}}">
                                </div>
                                {{-- STarting Price Field End --}}

                                {{-- Button Url Field --}}
                                <div class="form-group">
                                    <label for="">Button url</label>
                                    <input type="text" class="form-control" name="btn_url" value="{{old('btn_url')}}">
                                </div>
                                {{-- Button Url Field End --}}

                                {{-- Serial Field --}}
                                <div class="form-group">
                                    <label for="">Serial</label>
                                    <input type="text" class="form-control" name="serial" value="{{old('serial')}}">
                                </div>
                                {{-- Serial Field End --}}

                                {{-- Status Field End --}}
                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select name="status" id="inputState" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
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
