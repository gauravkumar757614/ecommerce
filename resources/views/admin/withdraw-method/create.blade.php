@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Withdraw Methods</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create method</h4>
                        </div>
                        <div class="card-body">
                            {{-- Create Category Form --}}
                            <form action="{{ route('admin.withdraw-method.store') }}" method="POST">
                                @csrf

                                {{-- Name Field --}}
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                </div>
                                {{-- Name Field End --}}

                                {{-- Minimum Amount Field --}}
                                <div class="form-group">
                                    <label for="">Minimum Amount</label>
                                    <input type="number" class="form-control" name="minimum_amount"
                                        value="{{ old('minimum_amount') }}">
                                </div>
                                {{-- Minimum Amount Field End --}}

                                {{-- Maximum Amount Field --}}
                                <div class="form-group">
                                    <label for="">Maximum Amount</label>
                                    <input type="number" class="form-control" name="maximum_amount"
                                        value="{{ old('maximum_amount') }}">
                                </div>
                                {{-- Maximum Amount Field End --}}

                                {{-- Withdraw Charge Field --}}
                                <div class="form-group">
                                    <label for="">Withdraw Charge (%)</label>
                                    <input type="number" class="form-control" name="withdraw_charge"
                                        value="{{ old('withdraw_charge') }}">
                                </div>
                                {{-- Withdraw Charge Field End --}}

                                {{-- Description Field --}}
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea class="form-control summernote" name="description">
                                    </textarea>
                                </div>
                                {{-- Description Field End --}}

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