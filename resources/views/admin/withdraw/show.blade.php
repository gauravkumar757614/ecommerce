@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1> Withdraw pending requests </h1>
        </div>

        <div class="section-body">
            <div class="invoice">
                <div class="invoice-print">

                    <div class="row mt-4">
                        <div class="col-md-12">

                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>
                                            <b>
                                                Withdraw method
                                            </b>
                                        </td>
                                        <td>
                                            {{ $withdraw->method }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <b>
                                                Withdraw Charge
                                            </b>
                                        </td>
                                        <td>
                                            {{ ($withdraw->withdraw_charge / $withdraw->total_amount) * 100 }} %
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <b>
                                                Withdraw Charge Amount
                                            </b>
                                        </td>
                                        <td>
                                            {{ $settings->currency_icon }}{{ $withdraw->withdraw_charge }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <b>
                                                Total Amount
                                            </b>
                                        </td>
                                        <td>
                                            {{ $settings->currency_icon }}{{ $withdraw->total_amount }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <b>
                                                Withdraw Amount
                                            </b>
                                        </td>
                                        <td>
                                            {{ $settings->currency_icon }}{{ $withdraw->withdraw_amount }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <b>
                                                Status
                                            </b>
                                        </td>
                                        <td>
                                            @if ($withdraw->status == 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @elseif ($withdraw->status == 'paid')
                                                <span class="badge bg-success">Paid</span>
                                            @else
                                                <span class="badge bg-danger">Declined</span>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <b>
                                                Account Information
                                            </b>
                                        </td>
                                        <td>
                                            {!! $withdraw->account_info !!}
                                        </td>
                                    </tr>


                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="section-body">
            <div class="invoice">
                <div class="invoice-print">

                    <div class="row mt-4">
                        <div class="col-md-4">
                            <form action="{{ route('admin.withdraw.update', $withdraw->id) }}" method="post">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select name="status" id="" class="form-control">
                                        <option @selected($withdraw->status == 'pending') value="pending">Pending</option>
                                        <option @selected($withdraw->status == 'paid') value="paid">Paid</option>
                                        <option @selected($withdraw->status == 'declined') value="declined">Declined</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
