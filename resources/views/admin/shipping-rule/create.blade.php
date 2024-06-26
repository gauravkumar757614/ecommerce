@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Shipping Rule</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Shipping Rule</h4>
                        </div>
                        <div class="card-body">
                            {{-- Create Category Form --}}
                            <form action="{{ route('admin.shipping-rules.store') }}" method="POST">
                                @csrf

                                {{-- Name Field --}}
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                </div>
                                {{-- Name Field End --}}

                                {{-- Type Field --}}
                                <div class="form-group">
                                    <label for="inputState">Type</label>
                                    <select name="type" id="inputState" class="form-control shipping-type">
                                        <option value="flat_cost">Flat Cost</option>
                                        <option value="min_cost">Minimum Order Amount </option>
                                    </select>
                                </div>
                                {{-- Type Field End --}}

                                {{-- Minimum Cost Field --}}
                                <div class="form-group min_cost d-none">
                                    <label for="">Minimum Cost</label>
                                    <input type="text" class="form-control" name="min_cost" value="{{ old('name') }}">
                                </div>
                                {{-- Minimum Cost Field End --}}

                                {{-- Cost Field --}}
                                <div class="form-group">
                                    <label for="">Cost</label>
                                    <input type="text" class="form-control" name="cost" value="{{ old('name') }}">
                                </div>
                                {{-- Cost Field End --}}

                                {{-- Status Field --}}
                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select name="status" id="inputState" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                {{-- Status Field End --}}

                                {{-- Submit Button --}}
                                <button type="submit" class="btn btn-primary">Create</button>
                                {{-- Submit Button End --}}
                            </form>
                            {{-- Create Category Form End --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('body').on('change', '.shipping-type', function() {
                let value = $(this).val();

                if (value != 'min_cost') {
                    $('.min_cost').addClass('d-none')
                } else {
                    $('.min_cost').removeClass('d-none')
                }
            })
        })
    </script>
@endpush
