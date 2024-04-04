@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Settings</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="row">
                                <div class="col-2">
                                    <div class="list-group" id="list-tab" role="tablist">
                                        <a class="list-group-item list-group-item-action active" id="banner-one-list"
                                            data-toggle="list" href="#banner-one" role="tab">
                                            Homepage banner section one
                                        </a>

                                        <a class="list-group-item list-group-item-action" id="banner-two-list"
                                            data-toggle="list" href="#banner-two" role="tab">
                                            Homepage banner section two
                                        </a>

                                        <a class="list-group-item list-group-item-action" id="banner-three-list"
                                            data-toggle="list" href="#banner-three" role="tab">
                                            Homepage banner section three
                                        </a>

                                        <a class="list-group-item list-group-item-action" id="banner-four-list"
                                            data-toggle="list" href="#banner-four" role="tab">
                                            Homepage banner section four
                                        </a>

                                        <a class="list-group-item list-group-item-action" id="list-product-list"
                                            data-toggle="list" href="#list-product" role="tab">
                                            Product's page banner
                                        </a>

                                        <a class="list-group-item list-group-item-action" id="list-cart-list"
                                            data-toggle="list" href="#list-cart" role="tab">
                                            Cart page banner
                                        </a>

                                    </div>
                                </div>
                                <div class="col-10">
                                    <div class="tab-content" id="nav-tabContent">

                                        @include('admin.advertisement.banner-section-one')

                                        @include('admin.advertisement.banner-section-two')

                                        @include('admin.advertisement.banner-section-three')

                                        @include('admin.advertisement.banner-section-four')

                                        @include('admin.advertisement.product-page-banner')

                                        @include('admin.advertisement.cart-page-banner')

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
