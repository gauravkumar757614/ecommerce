@extends('vendor.layouts.master')


@section('title')
    {{ $settings->site_name }} || Withdraw Requests Show
@endsection

@section('content')
    {{-- DASHBOARD START --}}
    <section id="wsus__dashboard">
        <div class="container-fluid">
            {{-- Sidebar --}}
            @include('vendor.layouts.sidebar')
            {{-- Sidebar End --}}

            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> All withdraw request</h3>

                        <div class="wsus__dashboard_profile">
                            <div class="row">
                                <div class="wsus__dash_pro_area col-md-6">

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
                                                    {{$settings->currency_icon}}{{ $withdraw->withdraw_charge }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <b>
                                                        Total Amount
                                                    </b>
                                                </td>
                                                <td>
                                                    {{$settings->currency_icon}}{{ $withdraw->total_amount }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <b>
                                                        Withdraw Amount
                                                    </b>
                                                </td>
                                                <td>
                                                  {{$settings->currency_icon}}{{ $withdraw->withdraw_amount }}
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
            </div>
        </div>
    </section>
    {{-- DASHBOARD START --}}
@endsection
