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
                            <h4>Footer Grid Two Title</h4>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('admin.footer-grid-two.change-title') }}" method="POST">
                                @csrf
                                @method('put')
                                {{-- Name Field --}}
                                <div class="form-group">
                                    <input type="text" class="form-control" name="title"
                                        value="{{ $footerTitle->footer_grid_two_title }}">
                                </div>
                                {{-- Name Field End --}}
                                {{-- Submit Button --}}
                                <button type="submit" class="btn btn-primary">Save</button>
                                {{-- Submit Button End --}}

                            </form>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="section">

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Footer Grid Two</h4>

                            <div class="card-header-action">
                                <a href="{{ route('admin.footer-grid-two.create') }}" class="btn btn-primary"> <i
                                        class="fas fa-plus"></i> Create new</a>
                            </div>
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

    <script>
        $(document).ready(function() {
            $('body').on('click', '.change-status', function() {
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                $.ajax({
                    url: "{{ route('admin.footer-grid-two.change-status') }}",
                    method: 'PUT',
                    data: {
                        status: isChecked,
                        id: id
                    },
                    success: function(data) {
                        toastr.success(data.message)
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }

                })
            })
        })
    </script>
@endpush
