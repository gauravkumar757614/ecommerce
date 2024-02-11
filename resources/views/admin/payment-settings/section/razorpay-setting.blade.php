<div class="tab-pane fade" id="list-razorpay" role="tabpanel" aria-labelledby="list-razorpay-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.razorpay-setting.update', 1) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="">Razorpay status</label>
                    <select name="status" id="" class="form-control">
                        <option {{ $razorpay->status == 1 ? 'selected' : '' }} value="1">Enable</option>
                        <option {{ $razorpay->status == 0 ? 'selected' : '' }} value="0">Disable</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Country Name</label>
                    <select name="country_name" id="" class="form-control select2">
                        <option value="">Select</option>
                        @foreach (config('setting.country_list') as $country)
                            <option {{ $razorpay->country_name == $country ? 'selected' : '' }}
                                value="{{ $country }}">{{ $country }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Currency Name</label>
                    <select name="currency_name" id="" class="form-control select2">
                        <option value="">Select</option>
                        @foreach (config('setting.currency_list') as $currency => $code)
                            <option {{ $razorpay->currency_name == $code ? 'selected' : '' }}
                                value="{{ $code }}">
                                {{ $currency }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Currency Rate (Per {{ $settings->currency_name }}) </label>
                    <input type="text" class="form-control" name="currency_rate"
                        value="{{ $razorpay->currency_rate }}">
                </div>

                <div class="form-group">
                    <label for="">Razorpay key </label>
                    <input type="text" class="form-control" name="razorpay_key"
                        value="{{ $razorpay->razorpay_key }}">
                </div>

                <div class="form-group">
                    <label for=""> Razorpay Secret Key </label>
                    <input type="text" class="form-control" name="razorpay_secret"
                        value="{{ $razorpay->razorpay_secret_key }}">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
