<div class="tab-pane fade" id="list-stripe" role="tabpanel" aria-labelledby="list-stripe-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.stripe-setting.update', 1) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="">Stripe status</label>
                    <select name="status" id="" class="form-control">
                        <option {{ $stripe->status == 1 ? 'selected' : '' }} value="1">Enable</option>
                        <option {{ $stripe->status == 0 ? 'selected' : '' }} value="0">Disable</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Account Mode</label>
                    <select name="mode" id="" class="form-control">
                        <option {{ $stripe->mode == 0 ? 'selected' : '' }} value="0">Sandbox</option>
                        <option {{ $stripe->mode == 1 ? 'selected' : '' }} value="1">Live</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Country Name</label>
                    <select name="country_name" id="" class="form-control select2">
                        <option value="">Select</option>
                        @foreach (config('setting.country_list') as $country)
                            <option {{ $stripe->country_name == $country ? 'selected' : '' }}
                                value="{{ $country }}">{{ $country }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Currency Name</label>
                    <select name="currency_name" id="" class="form-control select2">
                        <option value="">Select</option>
                        @foreach (config('setting.currency_list') as $currency => $code)
                            <option {{ $stripe->currency_name == $code ? 'selected' : '' }} value="{{ $code }}">
                                {{ $currency }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Currency Rate (Per {{ $settings->currency_name }}) </label>
                    <input type="text" class="form-control" name="currency_rate"
                        value="{{ $stripe->currency_rate }}">
                </div>

                <div class="form-group">
                    <label for="">Stripe Client Id </label>
                    <input type="text" class="form-control" name="client_id" value="{{ $stripe->client_id }}">
                </div>

                <div class="form-group">
                    <label for=""> Stripe Secret Key </label>
                    <input type="text" class="form-control" name="secret_key" value="{{ $stripe->secret_key }}">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
