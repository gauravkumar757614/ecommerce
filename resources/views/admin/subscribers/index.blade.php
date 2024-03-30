@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Subscribers</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Send Email To All Subscribers</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.subscriber-send-mail')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="">Subject:</label>
                                    <input type="text" class="form-control" name="subject">
                                </div>

                                <div class="form-group">
                                    <label for="">Message:</label>
                                    <textarea name="message" id="" cols="30" rows="10" class="form-control">
                                    </textarea>
                                </div>

                                <button type="submit" class="btn btn-primary"> Send </button>
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
                            <h4>All subscribers</h4>
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
                    url: "{{ route('admin.products.change-status') }}",
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
