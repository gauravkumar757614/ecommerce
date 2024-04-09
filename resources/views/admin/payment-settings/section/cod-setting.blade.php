<div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">

    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.cod-setting.update', 1) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="">COD status</label>
                    <select name="status" id="" class="form-control">
                        <option {{ $cod->status == 1 ? 'selected' : '' }} value="1">Enable</option>
                        <option {{ $cod->status == 0 ? 'selected' : '' }} value="0">Disable</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>

</div>
