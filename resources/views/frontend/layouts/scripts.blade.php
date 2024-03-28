<script>
    $(document).ready(function() {

        // Adding csrf token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Add product to cart
        $('.shopping-cart-form').on('submit', function(e) {
            e.preventDefault();
            let formData = $(this).serialize();
            // console.log(formData);
            $.ajax({
                method: 'POST',
                data: formData,
                url: "{{ route('add-to-cart') }}",

                success: function(data) {
                    if (data.status === 'success') {
                        getCartCount();
                        fetchSidebarProducts();
                        $('.mini_cart_actions').removeClass('d-none');
                        toastr.success(data.message);
                    } else if (data.status === 'error') {
                        toastr.error(data.message);
                    }
                },

                error: function(data) {

                }
            })
        })
        // Get the count of products present in the cart and display it on the bag icon
        function getCartCount() {
            $.ajax({
                method: 'GET',
                url: "{{ route('cart-count') }}",

                success: function(data) {
                    $('#cart-count').text(data);
                },

                error: function(data) {

                }
            })
        }

        // Fetch all the products in the sidebar cart
        function fetchSidebarProducts() {
            $.ajax({
                method: 'GET',
                url: "{{ route('cart-products') }}",

                success: function(data) {
                    console.log(data);
                    $('.mini_cart_wrapper').html("");
                    var html = '';

                    for (let item in data) {
                        let product = data[item];
                        html += `
                        <li id="mini_cart_${ product.rowId }">
                            <div class="wsus__cart_img">

                                <a href="{{ url('product-details') }}/${product.options.slug}">
                                    <img src="{{ asset('/') }}${product.options.image} " alt="product" class="img-fluid w-100">
                                </a>

                                <a class="wsis__del_icon remove_sidebar_product" data-id="${product.rowId}" href="#"><i class="fas fa-minus-circle"></i></a>

                                </div>
                            <div class="wsus__cart_text">
                                <a class="wsus__cart_title" href="{{ url('product-details') }}/${product.options.slug}">
                                    ${product.name}
                                </a>
                                <p> {{ $settings->currency_icon }} ${product.price}</p>

                                <small> Variants total: {{ $settings->currency_icon }}
                                    ${ product.options.variants_total } </small>
                                    <br>
                                <small> Qty: ${ product.qty } </small>
                            </div>
                        </li>


                                `;
                    }

                    $('.mini_cart_wrapper').html(html);
                    getSideBarCartSubTotal();
                },

                error: function(data) {

                }
            })
        }

        // Remove product from sidebar cart
        $('body').on('click', '.remove_sidebar_product', function(e) {
            e.preventDefault();
            let rowId = $(this).data('id');
            $.ajax({
                method: 'POST',
                url: "{{ route('cart/remove-sidebar-products') }}",

                data: {
                    rowId: rowId
                },

                success: function(data) {
                    let productId = '#mini_cart_' + rowId;
                    $(productId).remove();
                    getSideBarCartSubTotal();
                    // If cart is empty displaying empty message
                    if ($('.mini_cart_wrapper').find('li').length === 0) {
                        $('.mini_cart_actions').addClass('d-none');
                        $('.mini_cart_wrapper').html(
                            '<li class="text-center" > Cart is empty! </li>');
                    }

                    toastr.success(data.message);

                },

                error: function(data) {
                    console.log(data);
                }
            })
        })

        // Get sidebar product sub total
        function getSideBarCartSubTotal() {
            $.ajax({
                method: 'GET',
                url: "{{ route('cart.sidebar-products-total') }}",

                success: function(data) {
                    $('#mini_cart_subtotal').text("{{ $settings->currency_icon }}" + data);
                },

                error: function(data) {

                }
            })
        }

        // Add product to wish list
        $('.add_to_wishlist').on('click', function(e) {
            e.preventDefault();
            let id = $(this).data('id');

            $.ajax({
                method: 'POST',
                url: "{{ route('user.wishlist.store') }}",
                data: {
                    id: id
                },
                success: function(data) {
                    if (data.status == 'success') {
                        $('#wishlist_count').text(data.count);
                        toastr.success(data.message);
                    } else if (data.status == 'error') {
                        toastr.error(data.message);
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            })
        })
    })
</script>
