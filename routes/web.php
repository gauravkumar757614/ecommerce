<?php

use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\CheckOutController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\FlashSaleController;
use App\Http\Controllers\Frontend\FrontendProductController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewsLetterController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\ProductTrackController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\UserAddressController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Frontend\UserMessageController;
use App\Http\Controllers\Frontend\UserOrderController;
use App\Http\Controllers\Frontend\UserVendorRequestController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/**
 * This route will return the home page
 */
Route::get('/', [HomeController::class, 'index'])->name('home');

//=============================================================================



/**
 * Following all are the breeze default routes
 */

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
//======================================================================================================

//  Flash sale routes
Route::get('flash-sale', [FlashSaleController::class, 'index'])->name('flash-sale.index');

//  Products routes
Route::get('products', [FrontendProductController::class, 'productsIndex'])->name('products.index');
Route::get('product-details/{slug}', [FrontendProductController::class, 'showDetails'])->name('product-details');
Route::get('change-product-list-view', [FrontendProductController::class, 'changeListView'])->name('change-product-list-view');

//  Cart routes
Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::get('cart-details', [CartController::class, 'cartDetail'])->name('cart-details');
Route::post('cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.update-quantity');
Route::get('clear-cart', [CartController::class, 'clearCart'])->name('clear.cart');
Route::get('cart/remove-product/{rowId}', [CartController::class, 'removeProduct'])->name('cart.remove-product');
Route::get('cart-count', [CartController::class, 'getCartCount'])->name('cart-count');
Route::get('cart-products', [CartController::class, 'getCartProducts'])->name('cart-products');
Route::post('cart/remove-sidebar-products', [CartController::class, 'removeSidebarProduct'])->name('cart/remove-sidebar-products');
Route::get('cart/sidebar-products-total', [CartController::class, 'cartTotal'])->name('cart.sidebar-products-total');

// Apply coupon route
Route::get('apply-coupon', [CartController::class, 'applyCoupon'])->name('apply-coupon');
// Calculating the amount of coupon route
Route::get('coupon-calculation', [CartController::class, 'couponCalculation'])->name('coupon-calculation');

// Newsletter routes
Route::post('news-letters-request', [NewsLetterController::class, 'newsLettersRequest'])->name('news-letters-request');
Route::get('news-letters-verification/{token}', [NewsLetterController::class, 'newsLettersEmailVerify'])->name('news-letters-verification');

// Vendor profile routes
Route::get('vendor-profile', [HomeController::class, 'vendorPage'])->name('vendor-profile-page');
Route::get('vendor-products/{id}', [HomeController::class, 'vendorProductsPage'])->name('vendor-products-page');

// Website related pages routes
Route::get('about', [PageController::class, 'index'])->name('about.index');
Route::get('terms-and-conditions', [PageController::class, 'termsAndConditions'])->name('terms-and-conditions');
Route::get('contact', [PageController::class, 'contact'])->name('contact');
Route::post('contact', [PageController::class, 'handleContactForm'])->name('handle-contact-form');

// Order tracking routes
Route::get('product-tracking', [ProductTrackController::class, 'index'])->name('product-tracking.index');

// Blog routes
Route::get('blog-details/{slug}', [BlogController::class, 'blogDetails'])->name('blog-details');
Route::get('blog', [BlogController::class, 'blog'])->name('blog');

// Add product to wishlist
Route::post('wishlist/add-product', [WishlistController::class, 'addToWishlist'])->name('wishlist.store');

// Show product modal route
Route::get('show-product-modal/{id}', [HomeController::class, 'showProductModal'])->name('show-product-modal');

/**
 * This is custom user related routes
 */
Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [UserProfileController::class, 'index'])->name('profile');
    Route::put('profile', [UserProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('profile', [UserProfileController::class, 'updatePassword'])->name('profile.update.password');

    // User address routes
    Route::resource('address', UserAddressController::class);

    // Messenger routes
    Route::get('messages', [UserMessageController::class, 'index'])->name('messages.index');
    Route::post('send-message', [UserMessageController::class, 'sendMessage'])->name('send-message');
    Route::get('get-messages', [UserMessageController::class, 'getMessages'])->name('get-messages');

    // Order routes
    Route::get('orders', [UserOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/show/{id}', [UserOrderController::class, 'show'])->name('orders.show');

    // Wish list routes
    Route::get('wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::delete('wishlist/remove-product/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');

    // Check out routes
    Route::get('checkout', [CheckOutController::class, 'index'])->name('checkout.index');
    Route::post('checkout/address-create', [CheckOutController::class, 'createAddress'])->name('checkout.address-create');
    Route::post('checkout/form-submit', [CheckOutController::class, 'checkoutFormSubmit'])->name('checkout.form-submit');

    // Product review route
    Route::post('review', [ReviewController::class, 'create'])->name('review.create');
    Route::get('reviews', [ReviewController::class, 'index'])->name('review.index');

    // Vendor request routes
    Route::get('vendor-request', [UserVendorRequestController::class, 'index'])->name('vendor-request.index');
    Route::post('vendor-request', [UserVendorRequestController::class, 'create'])->name('vendor-request.create');

    // Payment routes
    Route::get('payment', [PaymentController::class, 'index'])->name('payment.index');
    Route::get('payment-success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
    // Paypal routes
    Route::get('paypal/payment', [PaymentController::class, 'payWithPaypal'])->name('paypal.payment');
    Route::get('paypal/success', [PaymentController::class, 'paypalSuccess'])->name('paypal.success');
    Route::get('paypal/cancel', [PaymentController::class, 'paypalCancel'])->name('paypal.cancel');

    // Stripe routes
    Route::post('stripe/payment', [PaymentController::class, 'payWithStripe'])->name('stripe.payment');

    // Razorpay routes
    Route::post('razorpay/payment', [PaymentController::class, 'payWithRazorpay'])->name('razorpay.payment');

    // Cod routes
    Route::get('cod/payment', [PaymentController::class, 'payWithCod'])->name('cod.payment');

    // Blog comment route
    Route::post('blog-comment', [BlogController::class, 'blogComment'])->name('blog-comment');
});
