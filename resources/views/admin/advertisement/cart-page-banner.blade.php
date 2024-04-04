<div class="tab-pane fade" id="list-cart" role="tabpanel" aria-labelledby="list-cart-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.cartpage-banner') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <h5>Banner one</h5>
                {{-- Statu --}}
                <div class="form group">
                    <label for="">Status</label>
                    <br>
                    <label class="custom-switch mt-2">
                        <input type="checkbox" name="banner_one_status" class="custom-switch-input"
                            {{ @$cartpage_content['banner_one']['banner_status'] == 1 ? 'checked' : '' }}>
                        <span class="custom-switch-indicator"></span>
                    </label>
                </div>

                {{-- Preview image --}}
                <div class="form-group">
                    <label for="">Preview</label><br>
                    <img src="{{ asset(@$cartpage_content['banner_one']['banner_image']) }}" alt="banner one"
                        width="150px">
                </div>

                {{-- Image --}}
                <div class="form-group">
                    <label for="">Banner Image</label>
                    <input type="file" class="form-control" name="banner_one_image" value="">
                    <input type="hidden" class="form-control" name="banner_one_old_image"
                        value="{{ @$cartpage_content['banner_one']['banner_image'] }}">
                </div>

                {{-- Url --}}
                <div class="form-group">
                    <label for="">Banner Url</label>
                    <input type="text" class="form-control" name="banner_one_url"
                        value="{{ @$cartpage_content['banner_one']['banner_url'] }}">
                </div>

                <hr>
                <br>
                <h5>Banner two</h5>
                {{-- Statu --}}
                <div class="form group">
                    <label for="">Status</label>
                    <br>
                    <label class="custom-switch mt-2">
                        <input type="checkbox" name="banner_two_status" class="custom-switch-input"
                            {{ @$cartpage_content['banner_two']['banner_status'] == 1 ? 'checked' : '' }}>
                        <span class="custom-switch-indicator"></span>
                    </label>
                </div>

                {{-- Preview image --}}
                <div class="form-group">
                    <label for="">Preview</label><br>
                    <img src="{{ asset(@$cartpage_content['banner_two']['banner_image']) }}" alt="banner one"
                        width="150px">
                </div>

                {{-- Image --}}
                <div class="form-group">
                    <label for="">Banner Image</label>
                    <input type="file" class="form-control" name="banner_two_image" value="">
                    <input type="hidden" class="form-control" name="banner_two_old_image"
                        value="{{ @$cartpage_content['banner_two']['banner_image'] }}">
                </div>

                {{-- Url --}}
                <div class="form-group">
                    <label for="">Banner Url</label>
                    <input type="text" class="form-control" name="banner_two_url"
                        value="{{ @$cartpage_content['banner_two']['banner_url'] }}">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>

            </form>
        </div>
    </div>

</div>
