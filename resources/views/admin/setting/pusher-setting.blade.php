<div class="tab-pane fade" id="pusher-setting" role="tabpanel" aria-labelledby="list-pusher-list">

    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.pusher-setting-update') }}" method="POST">
                @csrf
                @method('PUT')

                {{-- App Id --}}
                <div class="form-group">
                    <label for="">App Id</label>
                    <input type="text" class="form-control" name="app_id" value="{{ @$pusherSetting->app_id }}">
                </div>

                {{-- Key --}}
                <div class="form-group">
                    <label for="">Key</label>
                    <input type="text" class="form-control" name="key" value="{{ @$pusherSetting->key }}">
                </div>

                {{-- Secret --}}
                <div class="form-group">
                    <label for="">Secret</label>
                    <input type="text" class="form-control" name="secret" value="{{ @$pusherSetting->secret }}">
                </div>

                {{-- Cluster --}}
                <div class="form-group">
                    <label for="">Cluster</label>
                    <input type="text" class="form-control" name="cluster" value="{{ @$pusherSetting->cluster }}">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>


</div>
