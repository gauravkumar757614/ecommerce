@php
    $categories = \App\Models\Category::where('status', 1)
        ->with([
            'subCategories' => function ($query) {
                $query->where('status', 1)->with([
                    'childCategories' => function ($query) {
                        $query->where('status', 1);
                    },
                ]);
            },
        ])
        ->get();
@endphp

{{-- MAIN MENU START --}}
<nav class="wsus__main_menu d-none d-lg-block">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="relative_contect d-flex">
                    <div class="wsus_menu_category_bar">
                        <i class="far fa-bars"></i>
                    </div>
                    <ul class="wsus_menu_cat_item show_home toggle_menu">
                        {{-- <li><a href="#"><i class="fas fa-star"></i> hot promotions</a></li> --}}

                        {{-- Looping through available categories --}}
                        @foreach ($categories as $category)
                            <li><a class="{{ count($category->subCategories) > 0 ? 'wsus__droap_arrow' : '' }}"
                                    href="{{ route('products.index', ['category' => $category->slug]) }}"><i
                                        class="{{ $category->icon }}"></i>
                                    {{ $category->name }} </a>

                                @if (count($category->subCategories) > 0)
                                    {{-- Looping through available sub category of parent category --}}
                                    <ul class="wsus_menu_cat_droapdown">
                                        @foreach ($category->subCategories as $subCategory)
                                            <li>
                                                <a
                                                    href="{{ route('products.index', ['subcategory' => $subCategory->slug]) }}">
                                                    {{ $subCategory->name }} <i
                                                        class="{{ count($subCategory->childCategories) > 0 ? 'fas fa-angle-right' : '' }}"></i>
                                                </a>
                                                {{-- If sub category has child category show side bar else not --}}
                                                @if (count($subCategory->childCategories) > 0)
                                                    <ul class="wsus__sub_category">

                                                        {{-- Looping through availabe child category of sub category --}}
                                                        @foreach ($subCategory->childCategories as $childCategory)
                                                            <li>
                                                                <a
                                                                    href=" {{ route('products.index', ['childcategory' => $childCategory->slug]) }} ">{{ $childCategory->name }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                        {{-- Looping through availabe child category of sub category end --}}
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                    {{-- Looping through available sub category of parent category --}}
                                @endif
                            </li>
                        @endforeach
                        {{-- Looping through available categories end --}}

                        <li><a href="#"><i class="fal fa-gem"></i> View All Categories</a></li>
                    </ul>

                    <ul class="wsus__menu_item">
                        <li>
                            <a class="{{ setActive(['home']) }}" href="{{ url('/') }}">
                                home
                            </a>
                        </li>

                        <li>
                            <a class="{{ setActive(['vendor-profile-page']) }}"
                                href="{{ route('vendor-profile-page') }}">
                                vendor
                            </a>
                        </li>

                        <li>
                            <a class="{{ setActive(['flash-sale.index']) }}" href="{{ route('flash-sale.index') }}">
                                Flash Sale
                            </a>
                        </li>

                        <li>
                            <a class="{{ setActive(['blog']) }}" href="{{ route('blog') }}">
                                Blog
                            </a>
                        </li>

                        <li>
                            <a class="{{ setActive(['about.index']) }}" href="{{ route('about.index') }}">
                                About
                            </a>
                        </li>

                        <li><a class="{{ setActive(['contact']) }}" href="{{ route('contact') }}">contact</a></li>
                    </ul>

                    <ul class="wsus__menu_item wsus__menu_item_right">
                        <li><a href="{{ route('product-tracking.index') }}">track order</a></li>

                        @if (auth()->check())
                            @if (auth()->user()->role == 'user')
                                <li><a href="{{ route('user.dashboard') }}">user account</a></li>
                            @elseif (auth()->user()->role == 'vendor')
                                <li><a href="{{ route('vendor.dashboard') }}">vendor account</a></li>
                            @elseif (auth()->user()->role == 'admin')
                                <li><a href="{{ route('admin.dashboard') }}">admin account</a></li>
                            @endif
                        @else
                            <li><a href="{{ route('login') }}">login</a></li>
                        @endif

                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
{{-- MAIN MENU END --}}

{{-- MOBILE MENU START --}}
<section id="wsus__mobile_menu">
    <span class="wsus__mobile_menu_close"><i class="fal fa-times"></i></span>
    <ul class="wsus__mobile_menu_header_icon d-inline-flex">

        {{-- Mobile menu wish list --}}
        {{-- Wish list --}}
        <li>
            <a href="{{ route('user.wishlist.index') }}">
                <i class="fal fa-heart"></i>
                <span id="wishlist_count">
                    {{ auth()->check() ? \App\Models\Wishlist::where('user_id', auth()->user()->id)->count() : 0 }}
                </span>
            </a>
        </li>

        {{-- Conditional showing dashboard --}}
        @if (auth()->check())
            @if (auth()->user()->role == 'user')
                <li>
                    <a href="{{ route('user.dashboard') }}">
                        <i class="fal fa-user"></i>
                    </a>
                </li>
            @elseif (auth()->user()->role == 'vendor')
                <li>
                    <a href="{{ route('vendor.dashboard') }}">
                        <i class="fal fa-user"></i>
                    </a>
                </li>
            @elseif (auth()->user()->role == 'admin')
                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fal fa-user"></i>
                    </a>
                </li>
            @endif
        @else
            <li>
                <a href="{{ route('login') }}">
                    <i class="fal fa-user"></i>
                </a>
            </li>
        @endif
    </ul>

    {{-- Search box --}}
    <form action="{{ route('products.index') }}">
        <input type="text" placeholder="Search..." name="search" value="{{ request()->search }}">
        <button type="submit"><i class="far fa-search"></i></button>
    </form>

    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                role="tab" aria-controls="pills-home" aria-selected="true">Categories</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                role="tab" aria-controls="pills-profile" aria-selected="false">main menu</button>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

            <div class="wsus__mobile_menu_main_menu">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <ul class="wsus_mobile_menu_category">
                        {{-- Looping through available categories --}}
                        @foreach ($categories as $categoryItem)
                            <li>
                                <a href="#"
                                    class="{{ count($categoryItem->subCategories) > 0 ? 'accordion-button' : '' }} collapsed"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseThreew-{{ $loop->index }}" aria-expanded="false"
                                    aria-controls="flush-collapseThreew-{{ $loop->index }}"><i
                                        class="{{ $categoryItem->icon }}"></i>
                                    {{ $categoryItem->name }}</a>
                                {{-- Displaying sub category if parent category has one --}}

                                @if (count($categoryItem->subCategories) > 0)
                                    <div id="flush-collapseThreew-{{ $loop->index }}"
                                        class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            @foreach ($categoryItem->subCategories as $subCategoryItem)
                                                <ul>
                                                    <li><a href="#">{{ $subCategoryItem->name }}</a></li>
                                                </ul>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                {{-- Displaying sub category if parent category has one --}}
                            </li>
                        @endforeach
                        {{-- Looping through available categories end --}}
                    </ul>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="wsus__mobile_menu_main_menu">
                <div class="accordion accordion-flush" id="accordionFlushExample2">
                    <ul>
                        <li>
                            <a href="{{ url('/') }}">
                                home
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('vendor-profile-page') }}">
                                vendor
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('flash-sale.index') }}">
                                Flash sale
                            </a>
                        </li>

                        <li>
                            <a class="{{ setActive(['blog']) }}" href="{{ route('blog') }}">
                                Blog
                            </a>
                        </li>

                        <li>
                            <a class="{{ setActive(['about.index']) }}" href="{{ route('about.index') }}">
                                About
                            </a>
                        </li>

                        <li>
                            <a class="{{ setActive(['contact']) }}" href="{{ route('contact') }}">
                                contact
                            </a>
                        </li>


                        <li>
                            <a href="{{ route('product-tracking.index') }}">
                                track order
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- MOBILE MENU END --}}
