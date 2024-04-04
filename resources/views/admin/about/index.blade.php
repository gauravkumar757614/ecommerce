@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>About</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Vendor terms and conditions</h4>
                        </div>
                        <div class="card-body">
                            {{-- Create Category Form --}}
                            <form action="{{ route('admin.about.update') }}" method="POST">
                                @csrf
                                @method('put')

                                {{-- Name Field --}}
                                <div class="form-group">
                                    <label for="">Terms and conditions</label>
                                    <textarea class="summernote" name="content" value="{{ old('name') }}"> {!! @$content->content !!} </textarea>
                                </div>
                                {{-- Name Field End --}}

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
