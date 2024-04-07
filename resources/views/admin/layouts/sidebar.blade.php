<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown active">
                <a href="{{ route('admin.dashboard') }}" class="nav-link"><i
                        class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Starter</li>

            {{-- Category Dropdown --}}
            <li
                class="dropdown {{ setActive(['admin.category.*', 'admin.sub-category.*', 'admin.child-category.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Manage Category</span></a>
                <ul class="dropdown-menu">
                    <li class=" {{ setActive(['admin.category.*']) }}"><a class="nav-link"
                            href="{{ route('admin.category.index') }}">Category</a></li>
                    <li class=" {{ setActive(['admin.sub-category.*']) }}"><a class="nav-link"
                            href="{{ route('admin.sub-category.index') }}">Sub Category</a></li>
                    <li class=" {{ setActive(['admin.child-category.*']) }}"> <a class="nav-link"
                            href="{{ route('admin.child-category.index') }}">Child Category</a></li>
                </ul>
            </li>
            {{-- Category Dropdown End --}}

            {{-- Orders dropdown --}}
            <li class="dropdown {{ setActive(['admin.order.*', 'admin.pending.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Orders</span></a>

                <ul class="dropdown-menu">
                    <li class=" {{ setActive(['admin.order.index']) }}"><a class="nav-link"
                            href="{{ route('admin.order.index') }}">All Orders</a></li>
                    <li class=" {{ setActive(['admin.pending.*']) }}"><a class="nav-link"
                            href="{{ route('admin.pending.order') }}">All Pending Orders</a></li>
                    <li class=" {{ setActive(['admin.order.processed']) }}"><a class="nav-link"
                            href="{{ route('admin.order.processed') }}">All Processed Orders</a></li>
                    <li class=" {{ setActive(['admin.order.dropped-off']) }}"><a class="nav-link"
                            href="{{ route('admin.order.dropped-off') }}">All Dropped Off Orders</a></li>
                    <li class=" {{ setActive(['admin.order.shipped']) }}"><a class="nav-link"
                            href="{{ route('admin.order.shipped') }}">All Shipped Orders</a></li>
                    <li class=" {{ setActive(['admin.order.out-for-delivery']) }}"><a class="nav-link"
                            href="{{ route('admin.order.out-for-delivery') }}">All Out For Delivery Orders</a></li>
                    <li class=" {{ setActive(['admin.order.delivered']) }}"><a class="nav-link"
                            href="{{ route('admin.order.delivered') }}">All Delivered Orders</a></li>
                    <li class=" {{ setActive(['admin.order.canceled']) }}"><a class="nav-link"
                            href="{{ route('admin.order.canceled') }}">All Canceled Orders</a></li>

                </ul>
            </li>
            {{-- Orders dropdown end --}}

            {{-- Transactions --}}
            <li class="{{ setActive(['admin.transaction.*']) }}"><a
                    class="nav-link {{ setActive(['admin.transaction.*']) }}"
                    href="{{ route('admin.transaction.index') }}"><i class="far fa-square"></i>
                    <span>Transaction</span></a></li>
            {{-- Transactions end --}}

            {{-- Manage Product --}}
            <li
                class="dropdown {{ setActive([
                    'admin.brand.*',
                    'admin.products.*',

                    'admin.products-image-gallery.*',
                    'admin.products-variant.*',
                    'admin.products-variant-item.*',

                    'admin.seller-products.*',
                    'admin.seller-pending-products.*',
                    'admin.reviews.*',
                ]) }}">

                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Manage Products</span></a>
                <ul class="dropdown-menu">

                    <li class="{{ setActive(['admin.brand.*']) }}"><a class="nav-link"
                            href="{{ route('admin.brand.index') }}">Brands</a>
                    </li>

                    <li
                        class="{{ setActive([
                            'admin.products.*',
                            'admin.products-image-gallery.*',
                            'admin.products-variant.*',
                            'admin.products-variant-item.*',
                        ]) }}">
                        <a class="nav-link" href="{{ route('admin.products.index') }}">Products</a>
                    </li>

                    <li class="{{ setActive(['admin.seller-products.*']) }}"><a class="nav-link"
                            href="{{ route('admin.seller-products.index') }}">Seller Products</a>
                    </li>

                    <li class="{{ setActive(['admin.seller-pending-products.*']) }}"><a class="nav-link"
                            href="{{ route('admin.seller-pending-products.index') }}">Seller Pending Products</a>
                    </li>

                    <li class="{{ setActive(['admin.reviews.*']) }}"><a class="nav-link"
                            href="{{ route('admin.reviews.index') }}">Product Reviews</a>
                    </li>

                </ul>
            </li>
            {{-- Manage Product End --}}

            {{-- Manage Vendor --}}
            <li
                class="dropdown {{ setActive([
                    'admin.vendor-profile.*',
                    'admin.flash-sale.*',
                    'admin.coupons.*',
                    'admin.shipping-rules.*',
                    'admin.payment-setting.*',
                ]) }}">

                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Ecommerce</span></a>
                <ul class="dropdown-menu">

                    <li class="{{ setActive(['admin.vendor-profile.*']) }}"><a class="nav-link"
                            href="{{ route('admin.vendor-profile.index') }}">Vendor Profiles</a>
                    </li>

                    <li class="{{ setActive(['admin.coupons.*']) }}"><a class="nav-link"
                            href="{{ route('admin.coupons.index') }}">Coupons</a>
                    </li>

                    <li class="{{ setActive(['admin.shipping-rules.*']) }}"><a class="nav-link"
                            href="{{ route('admin.shipping-rules.index') }}">Shipping Rule</a>
                    </li>

                    <li class="{{ setActive(['admin.flash-sale.*']) }}"><a class="nav-link"
                            href="{{ route('admin.flash-sale.index') }}">Flash Sale</a>
                    </li>

                    <li class="{{ setActive(['admin.payment-setting.*']) }}"><a class="nav-link"
                            href="{{ route('admin.payment-setting.index') }}"> Payment Settings</a>
                    </li>

                </ul>
            </li>
            {{-- Manage Vendor End --}}

            {{-- Manage Website --}}
            <li
                class="dropdown
                                {{ setActive([
                                    'admin.slider.*',
                                    'admin.home-page-setting.*',
                                    'admin.vendor-conditions.*',
                                    'admin.about.*',
                                    'admin.terms-and-conditions.*',
                                ]) }}">

                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-columns"></i>
                    <span>Manage Website</span></a>
                <ul class="dropdown-menu">

                    <li class="{{ setActive(['admin.slider.*']) }}"><a class="nav-link"
                            href="{{ route('admin.slider.index') }}">Slider</a></li>

                    <li class="{{ setActive(['admin.home-page-setting.*']) }}">
                        <a class="nav-link" href="{{ route('admin.home-page-setting.index') }}">Home Page Settings
                        </a>
                    </li>

                    <li class="{{ setActive(['admin.vendor-conditions.*']) }}">
                        <a class="nav-link" href="{{ route('admin.vendor-conditions.index') }}">Vendor Conditions
                        </a>
                    </li>

                    <li class="{{ setActive(['admin.about.*']) }}">
                        <a class="nav-link" href="{{ route('admin.about.index') }}">About Page
                        </a>
                    </li>

                    <li class="{{ setActive(['admin.terms-and-conditions.*']) }}">
                        <a class="nav-link" href="{{ route('admin.terms-and-conditions.index') }}">Terms Page
                        </a>
                    </li>

                </ul>
            </li>
            {{-- Manage Website End --}}

            {{-- Manage Blog --}}
            <li
                class="dropdown
                                {{ setActive(['admin.blog-category.*', 'admin.blog.*', 'admin.blog-comments.*']) }}">

                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-columns"></i>
                    <span>Manage Blog</span>
                </a>
                <ul class="dropdown-menu">

                    <li class="{{ setActive(['admin.blog-category.*']) }}">
                        <a class="nav-link" href="{{ route('admin.blog-category.index') }}">
                            Categories
                        </a>
                    </li>

                    <li class="{{ setActive(['admin.blog.*']) }}">
                        <a class="nav-link" href="{{ route('admin.blog.index') }}">
                            Blogs
                        </a>
                    </li>

                    <li class="{{ setActive(['admin.blog-comments.*']) }}">
                        <a class="nav-link" href="{{ route('admin.blog-comments.index') }}">
                            Blog comments
                        </a>
                    </li>

                </ul>
            </li>
            {{-- Manage Blog End --}}

            {{-- Manage Footer --}}
            <li
                class="dropdown
                                {{ setActive([
                                    'admin.footer-info.*',
                                    'admin.footer-socials.*',
                                    'admin.footer-grid-two.*',
                                    'admin.footer-grid-three.*',
                                ]) }}">

                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-columns"></i>
                    <span>Manage Footer</span>
                </a>
                <ul class="dropdown-menu">

                    <li class="{{ setActive(['admin.footer-info.*']) }}">
                        <a class="nav-link" href="{{ route('admin.footer-info.index') }}">
                            Footer Info
                        </a>
                    </li>

                    <li class="{{ setActive(['admin.footer-socials.*']) }}">
                        <a class="nav-link" href="{{ route('admin.footer-socials.index') }}">
                            Footer Socials
                        </a>
                    </li>

                    <li class="{{ setActive(['admin.footer-grid-two.*']) }}">
                        <a class="nav-link" href="{{ route('admin.footer-grid-two.index') }}">
                            Footer Grid Two
                        </a>
                    </li>

                    <li class="{{ setActive(['admin.footer-grid-three.*']) }}">
                        <a class="nav-link" href="{{ route('admin.footer-grid-three.index') }}">
                            Footer Grid Three
                        </a>
                    </li>

                </ul>
            </li>
            {{-- Manage Footer End --}}

            {{-- Manage Pending Vendor Request --}}
            <li
                class="dropdown
                  {{ setActive([
                      'admin.vendor-requests.*',
                      'admin.customers.*',
                      'admin.vendors-list.*',
                      'admin.manage-user.*',
                      'admin.admin-list.*',
                  ]) }}">

                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-columns"></i>
                    <span>Users</span></a>
                <ul class="dropdown-menu">

                    <li class="{{ setActive(['admin.customers.*']) }}">
                        <a class="nav-link" href="{{ route('admin.customers.index') }}">
                            Customer List
                        </a>
                    </li>

                    <li class="{{ setActive(['admin.vendors-list.*']) }}">
                        <a class="nav-link" href="{{ route('admin.vendors-list.index') }}">
                            Vendor List
                        </a>
                    </li>

                    <li class="{{ setActive(['admin.vendor-requests.*']) }}">
                        <a class="nav-link" href="{{ route('admin.vendor-requests.index') }}">
                            Pending vendor requests
                        </a>
                    </li>

                    <li class="{{ setActive(['admin.admin-list.*']) }}">
                        <a class="nav-link" href="{{ route('admin.admin-list.index') }}">
                            Admin List
                        </a>
                    </li>

                    <li class="{{ setActive(['admin.manage-user.*']) }}">
                        <a class="nav-link" href="{{ route('admin.manage-user.index') }}">
                            Manage Users
                        </a>
                    </li>


                </ul>
            </li>
            {{-- Manage Pending Vendor Request End --}}

            {{-- Advertisement --}}
            <li class="{{ setActive(['admin.advertisement.*']) }}"><a class="nav-link "
                    href="{{ route('admin.advertisement.index') }}"><i class="far fa-square"></i>
                    <span>Advertisement</span></a></li>
            {{-- End Advertisement --}}

            {{-- Subscribers --}}
            <li class="{{ setActive(['admin.settings.*']) }}"><a class="nav-link "
                    href="{{ route('admin.settings.index') }}"><i class="far fa-square"></i>
                    <span>Settings</span></a></li>
            {{-- End Subscribers --}}

            {{-- Settings --}}
            <li class="{{ setActive(['admin.subscribers.*']) }}"><a class="nav-link "
                    href="{{ route('admin.subscribers.index') }}">
                    <i class="far fa-square"></i>
                    <span>Subscribers</span>
                </a>
            </li>
            {{-- End settings --}}




            {{-- For later Use --}}
            {{-- <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Layout</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
                    <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
                    <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
                </ul>
            </li> --}}
            {{-- For later Use --}}


            {{-- <li><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>Blank Page</span></a></li> --}}
        </ul>
    </aside>
</div>
