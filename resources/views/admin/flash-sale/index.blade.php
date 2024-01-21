@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Flash Sale</h1>
        </div>
        {{-- Flash Sale End Date --}}
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Flash End Date</h4>
                        </div>
                        <div class="card-body">

                            <form action="">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Sale End Date</label>
                                        <input type="text" class="form-control datepicker" name="end_date"
                                            value="">
                                    </div>
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        {{-- Add Flash Sale Products --}}
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Add Flash Sale Products</h4>
                        </div>
                        <div class="card-body">
                            <form action="">
                                <div class="form-group">
                                    <label for="">Sale End Date</label>
                                    <select name="" id="" class="form-control select2">
                                        <option value="">

                                        </option>
                                    </select>
                                </div>
                                <button class="btn btn-primary" type="submit">Save</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- All Flash Sale Products --}}
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Flash Sale Products</h4>
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
