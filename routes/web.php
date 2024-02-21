<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Frontend\CheckOutController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\FlashSaleController;
use App\Http\Controllers\Frontend\FrontendProductController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\UserAddressController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Frontend\UserOrderController;
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

Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
//======================================================================================================

//  Flash sale routes
Route::get('flash-sale', [FlashSaleController::class, 'index'])->name('flash-sale.index');

//  Product detials routes
Route::get('product-details/{slug}', [FrontendProductController::class, 'showDetails'])->name('product-details');

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

    // Order routes
    Route::get('orders', [UserOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/show/{id}', [UserOrderController::class, 'show'])->name('orders.show');

    // Check out routes
    Route::get('checkout', [CheckOutController::class, 'index'])->name('checkout.index');
    Route::post('checkout/address-create', [CheckOutController::class, 'createAddress'])->name('checkout.address-create');
    Route::post('checkout/form-submit', [CheckOutController::class, 'checkoutFormSubmit'])->name('checkout.form-submit');

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
});
