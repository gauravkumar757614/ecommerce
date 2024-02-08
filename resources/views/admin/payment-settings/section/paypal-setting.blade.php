<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.paypal-setting.update', 1) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="">Layout</label>
                    <select name="status" id="" class="form-control">
                        <option {{ $payment->status == 1 ? 'selected' : '' }} value="1">Enable</option>
                        <option {{ $payment->status == 0 ? 'selected' : '' }} value="0">Disable</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Account Mode</label>
                    <select name="mode" id="" class="form-control">
                        <option {{ $payment->mode == 0 ? 'selected' : '' }} value="0">Sandbox</option>
                        <option {{ $payment->mode == 1 ? 'selected' : '' }} value="1">Live</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Country Name</label>
                    <select name="country_name" id="" class="form-control select2">
                        <option value="">Select</option>
                        @foreach (config('setting.country_list') as $country)
                            <option {{ $payment->country_name == $country ? 'selected' : '' }}
                                value="{{ $country }}">{{ $country }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Currency Name</label>
                    <select name="currency_name" id="" class="form-control select2">
                        <option value="">Select</option>
                        @foreach (config('setting.currency_list') as $currency => $code)
                            <option {{ $payment->currency_name == $code ? 'selected' : '' }}
                                value="{{ $code }}">{{ $currency }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Currency Rate (Per USD) </label>
                    <input type="text" class="form-control" name="currency_rate"
                        value="{{ $payment->currency_rate }}">
                </div>

                <div class="form-group">
                    <label for="">Paypal Client Id </label>
                    <input type="text" class="form-control" name="client_id" value="{{ $payment->client_id }}">
                </div>

                <div class="form-group">
                    <label for=""> Paypal Secret Key </label>
                    <input type="text" class="form-control" name="secret_key" value="{{ $payment->secret_key }}">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
