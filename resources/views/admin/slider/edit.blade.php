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
                            <h4>Edit Slider</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.slider.update', $row->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT');
                                {{-- Preview Image Field --}}
                                <div class="form-group">
                                    <label for="">Preview</label>
                                    <br>
                                    <img src="{{ asset($row->banner) }}" alt="slider_images" srcset="" width="100"
                                        height="100">
                                </div>
                                {{-- Preview Image Field End --}}

                                {{-- Image Field --}}
                                <div class="form-group">
                                    <label for="">Image</label>
                                    <input type="file" class="form-control" name="banner">
                                </div>
                                {{-- Image Field End --}}

                                {{-- Type Field --}}
                                <div class="form-group">
                                    <label for="">Type</label>
                                    <input type="text" class="form-control" name="type" value="{{ $row->type }}">
                                </div>
                                {{-- Type Field End --}}

                                {{-- Title Field --}}
                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input type="text" class="form-control" name="title" value="{{ $row->title }}">
                                </div>
                                {{-- Title Field End --}}

                                {{-- STarting Price Field --}}
                                <div class="form-group">
                                    <label for="">Starting price</label>
                                    <input type="text" class="form-control" name="starting_price"
                                        value="{{ $row->starting_price }}">
                                </div>
                                {{-- STarting Price Field End --}}

                                {{-- Button Url Field --}}
                                <div class="form-group">
                                    <label for="">Button url</label>
                                    <input type="text" class="form-control" name="btn_url" value="{{ $row->btn_url }}">
                                </div>
                                {{-- Button Url Field End --}}

                                {{-- Serial Field --}}
                                <div class="form-group">
                                    <label for="">Serial</label>
                                    <input type="text" class="form-control" name="serial" value="{{ $row->serial }}">
                                </div>
                                {{-- Serial Field End --}}

                                {{-- Status Field End --}}
                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select name="status" id="inputState" class="form-control">
                                        <option {{ $row->status == 1 ? 'selected' : '' }} value="1">Active</option>
                                        <option {{ $row->status == 0 ? 'selected' : '' }}value="0">Inactive</option>
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
