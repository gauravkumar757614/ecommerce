<div class="tab-pane fade" id="list-product" role="tabpanel" aria-labelledby="list-product-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.productpage-banner') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Statu --}}
                <div class="form group">
                    <label for="">Status</label>
                    <br>
                    <label class="custom-switch mt-2">
                        <input type="checkbox" name="status" class="custom-switch-input"
                            {{ @$productpage_content['banner_one']['status'] == 1 ? 'checked' : '' }}>
                        <span class="custom-switch-indicator"></span>
                    </label>
                </div>

                {{-- Preview image --}}
                <div class="form-group">
                    <label for="">Preview</label><br>
                    <img src="{{ asset(@$productpage_content['banner_one']['banner_image']) }}" alt="banner one"
                        width="150px">
                </div>

                {{-- Image --}}
                <div class="form-group">
                    <label for="">Banner Image</label>
                    <input type="file" class="form-control" name="banner_image" value="">
                    <input type="hidden" class="form-control" name="banner_old_image"
                        value="{{ @$productpage_content['banner_one']['banner_image'] }}">
                </div>

                {{-- Url --}}
                <div class="form-group">
                    <label for="">Banner Url</label>
                    <input type="text" class="form-control" name="banner_url"
                        value="{{ @$productpage_content['banner_one']['banner_url'] }}">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
