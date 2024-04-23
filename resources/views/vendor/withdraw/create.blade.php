@extends('vendor.layouts.master')


@section('title')
    {{ $settings->site_name }} || Create withdraw request
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
                        <h3><i class="far fa-user"></i> Create withdraw request</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="row">
                                {{-- Form for withdrawal request --}}
                                <div class="wsus__dash_pro_area col-md-6">

                                    {{-- Shop profile form --}}
                                    <form action="{{ route('vendor.withdraw.store') }}" method="POST">
                                        @csrf

                                        {{-- Method Field --}}
                                        <div class="form-group wsus_input">
                                            <label for="">Method</label>
                                            <select name="method" id="method" class="form-control">
                                                <option value="">Select</option>
                                                @foreach ($methods as $method)
                                                    <option value="{{ $method->id }}"> {{ $method->name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        {{-- Method Field End --}}

                                        {{-- Withdraw Amount Field --}}
                                        <div class="form-group wsus_input">
                                            <label for="">Withdraw Amount</label>
                                            <input type="number" class="form-control" name="amount" value="">
                                        </div>
                                        {{-- Withdraw Amount Field End --}}

                                        {{-- Account Information Field --}}
                                        <div class="form-group wsus_input">
                                            <label for="">Account Information</label>
                                            <textarea name="account_info" id="" cols="30" rows="10" class="form-control">
                                            </textarea>
                                        </div>
                                        {{-- Account Information Field End --}}

                                        <button class="btn btn-primary mt-3" type="submit">Create</button>
                                    </form>
                                    {{-- Shop profile form end --}}

                                </div>
                                {{-- Form for withdrawal request end --}}

                                {{-- Displaying available methods on the selected input --}}
                                <div class="wsus__dash_pro_area col-md-6 account_info_area">

                                </div>
                                {{-- Displaying available methods on the selected input end --}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- DASHBOARD START --}}
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#method').on('change', function(e) {
                let id = $(this).val();
                // Ajax request
                $.ajax({
                    method: 'GET',
                    url: "{{ route('vendor.withdraw.show', ':id') }}".replace(':id', id),

                    success: function(response) {
                        $('.account_info_area').html(
                            `
                            <h3>Payout range: {{ $settings->currency_icon }}${response.minimum_amount} - {{ $settings->currency_icon }}${response.maximum_amount}</h3>
                            <h4>Withdrawal charge: ${response.withdraw_charge}%</h4>
                            <p>
                                ${response.description}
                            </p>
                            `
                        )
                    },

                    error: function(error) {
                        console.log(error);
                    }

                })

            })
        })
    </script>
@endpush
