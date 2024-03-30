<div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">

    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.email-configuration') }}" method="POST">
                @csrf
                @method('PUT')
                {{-- Email --}}
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" class="form-control" name="email" value="{{$emailSetting->email}}">
                </div>
                {{-- Email end --}}

                {{-- Mail host --}}
                <div class="form-group">
                    <label for="">Mail Host</label>
                    <input type="text" class="form-control" name="host" value="{{$emailSetting->host}}">
                </div>
                {{-- Mail host end --}}

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Smtp Username</label>
                            <input type="text" class="form-control" name="username" value="{{$emailSetting->username}}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Smtp Password</label>
                            <input type="text" class="form-control" name="password" value="{{$emailSetting->password}}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Mail Port</label>
                            <input type="text" class="form-control" name="port" value="{{$emailSetting->port}}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Mail Encryption</label>
                            <select name="encryption" id="" class="form-control">
                                <option {{$emailSetting->encryption == 'tls' ? 'active' : '' }} value="tls">TLS</option>
                                <option {{$emailSetting->encryption == 'ssl' ? 'active' : '' }} value="ssl">SSl</option>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>

</div>
