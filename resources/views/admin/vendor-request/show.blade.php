@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1> Vendors pending requests </h1>
        </div>

        <div class="section-body">
            <div class="invoice">
                <div class="invoice-print">

                    <div class="row mt-4">
                        <div class="col-md-12">

                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-md">
                                    <tr>
                                        <td>User name:</td>
                                        <td>{{ $vendor->user->name }}</td>
                                    <tr>
                                        <td>User email:</td>
                                        <td>{{ $vendor->user->email }}</td>
                                    <tr>
                                        <td>Shop name:</td>
                                        <td>{{ $vendor->shop_name }}</td>
                                    <tr>
                                        <td>Shop email:</td>
                                        <td>{{ $vendor->email }}</td>
                                    <tr>
                                        <td>Shop phone:</td>
                                        <td>{{ $vendor->phone }}</td>
                                    <tr>
                                        <td>Shop address:</td>
                                        <td>{{ $vendor->address }}</td>
                                    <tr>
                                        <td>Description:</td>
                                        <td>{{ $vendor->description }}</td>
                                    </tr>

                                </table>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-8">

                                    <div class="col-md-4">
                                        <form action="{{ route('admin.vendor-requests.change-status', $vendor->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('put')
                                            <div class="form-group">
                                                <label for="action">Action</label>
                                                <select class="form-control" name="action">

                                                    <option {{ $vendor->status == 0 ? 'selected' : '' }} value="0">
                                                        Pending
                                                    </option>
                                                    <option {{ $vendor->status == 1 ? 'selected' : '' }} value="1">
                                                        Approved
                                                    </option>

                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Adding csrf token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // Ajax token end

            $('#order_status').on('change', function() {
                let status = $(this).val();
                let id = $(this).data('id');
                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.order.status') }}",
                    data: {
                        status: status,
                        id: id
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            toastr.success(data.message);
                        }
                    },
                    error: function(xhr, status, error) {

                    }
                })
            })

            $('#payment_status').on('change', function() {
                let id = $(this).data('id');
                let status = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.payment.status') }}",
                    data: {
                        status: status,
                        id: id
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            toastr.success(data.message);
                        }
                    },
                    error: function(xhr, status, error) {

                    }
                })
            })

            $('.print_invoice').on('click', function() {
                let printBody = $('.invoice-print');
                let originalContent = $('body').html();

                $('body').html(printBody.html());
                window.print();

                $('body').html(originalContent);
            })


        })
    </script>
@endpush
