<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminVendorProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\FlashSaleController;
use App\Http\Controllers\Backend\HomePageSettingController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PaymentSettingController;
use App\Http\Controllers\Backend\PaypalSettingController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageGalleryController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\ProductVariantItemController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\RazorpaySettingController;
use App\Http\Controllers\Backend\SellerProductController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\ShippingRuleController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\StripeSettingController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\TransactionController;
use Illuminate\Support\Facades\Route;

// Profile routes
Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
Route::get('profile', [ProfileController::class, 'index'])->name('profile');
Route::post('profile/update', [ProfileController::class, 'profileUpdate'])->name('profile.update');
Route::post('profile/update/password', [ProfileController::class, 'updatePassword'])->name('password.update');


// Slider route
Route::resource('slider', SliderController::class);

// Creating a change status route in the resource controller
Route::put('change-status', [CategoryController::class, 'changeStatus'])->name('category.change-status');
// Category route
Route::resource('category', CategoryController::class);


// Creating a change status route in the resource controller
Route::put('subcategory/change-status', [SubCategoryController::class, 'changeStatus'])->name('sub-category.change-status');
// Sub category route
Route::resource('sub-category', SubCategoryController::class);

// Creating a change status route in the resource controller
Route::put('child-category/change-status', [ChildCategoryController::class, 'changeStatus'])->name('child-category.change-status');
// Get all sub=categories related to selected main category route
Route::get('get-subcategories', [ChildCategoryController::class, 'getSubcategories'])->name('get-subcategories');
// Child category Route
Route::resource('child-category', ChildCategoryController::class);


// Creating a change status route in the resource controller
Route::put('brand/change-status', [BrandController::class, 'changeStatus'])->name('brand.change-status');
// Brand route
Route::resource('brand', BrandController::class);

// Vendor profile routes
Route::resource('vendor-profile', AdminVendorProfileController::class);

// Fetching related categories according to the selected one
Route::get('product/get-subcategories', [ProductController::class, 'getSubCategories'])->name('product.get-subcategories');
Route::get('product/get-child-categories', [ProductController::class, 'getChildCategories'])->name('product.get-child-categories');
Route::put('products/change-status', [ProductController::class, 'changeStatus'])->name('products.change-status');
// Products routes
Route::resource('products', ProductController::class);
// Products image gallery routes
Route::resource('products-image-gallery', ProductImageGalleryController::class);

// Creating a change status route in the resource controller
Route::put('products-variant/change-status', [ProductVariantController::class, 'changeStatus'])->name('products-variant.change-status');
// Products variant routes
Route::resource('products-variant', ProductVariantController::class);

// Product variant item routes
Route::get('products-variant-item/{productId}/{variantId}', [ProductVariantItemController::class, 'index'])->name('products-variant-item.index');
Route::get('products-variant-item/create/{productId}/{variantId}', [ProductVariantItemController::class, 'create'])->name('products-variant-item.create');
Route::post('products-variant-item', [ProductVariantItemController::class, 'store'])->name('products-variant-item.store');
Route::get('products-variant-item-edit/{variantItemId}', [ProductVariantItemController::class, 'edit'])->name('products-variant-item.edit');
Route::put('products-variant-item-update/{variantItemId}', [ProductVariantItemController::class, 'update'])->name('products-variant-item.update');
Route::delete('products-variant-item/{variantItemId}', [ProductVariantItemController::class, 'destroy'])->name('products-variant-item.destroy');
Route::put('products-variant-item/change-status}', [ProductVariantItemController::class, 'changeStatus'])->name('products-variant-item.change-status');

// Seller product routes
Route::get('seller-products', [SellerProductController::class, 'index'])->name('seller-products.index');
Route::get('seller-pending-products', [SellerProductController::class, 'pendingProducts'])->name('seller-pending-products.index');
Route::put('change-approve-status', [SellerProductController::class, 'changeApproveStatus'])->name('change-approve-status');

// Flash sale routes
Route::get('flash-sale', [FlashSaleController::class, 'index'])->name('flash-sale.index');
Route::put('flash-sale', [FlashSaleController::class, 'update'])->name('flash-sale.update');
Route::post('flash-sale/add-product', [FlashSaleController::class, 'addProduct'])->name('flash-sale.add-product');
Route::put('flash-sale/show-at-home/change-status', [FlashSaleController::class, 'changeShowAtHomeStatus'])->name('flash-sale.show-at-home.change-status');
Route::put('flash-sale-status', [FlashSaleController::class, 'changeStatus'])->name('flash-sale-status');
Route::delete('flash-sale/{id}', [FlashSaleController::class, 'destroy'])->name('flash-sale.destroy');


Route::put('coupons/change-status', [CouponController::class, 'changeStatus'])->name('coupons.change-status');
// Coupons Routes
Route::resource('coupons', CouponController::class);

Route::put('shipping-rules/change-status', [ShippingRuleController::class, 'changeStatus'])->name('shipping-rules.change-status');
// Coupons Routes
Route::resource('shipping-rules', ShippingRuleController::class);

// Orders routes
Route::get('payment-status', [OrderController::class, 'changePaymentStatus'])->name('payment.status');
Route::get('order-status', [OrderController::class, 'changeOrderStatus'])->name('order.status');
Route::get('pending-order', [OrderController::class, 'pendingOrder'])->name('pending.order');
Route::get('order-processed', [OrderController::class, 'orderProcessed'])->name('order.processed');
Route::get('order-dropped-off', [OrderController::class, 'orderDroppedOff'])->name('order.dropped-off');
Route::get('order-shipped', [OrderController::class, 'orderShipped'])->name('order.shipped');
Route::get('order-out-for-delivery', [OrderController::class, 'orderOutForDelivery'])->name('order.out-for-delivery');
Route::get('order-delivered', [OrderController::class, 'orderDelivered'])->name('order.delivered');
Route::get('order-canceled', [OrderController::class, 'orderCanceled'])->name('order.canceled');
Route::resource('order', OrderController::class);
// Transactions of order routes
Route::get('transaction', [TransactionController::class, 'index'])->name('transaction.index');

// General settings routes
Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
Route::put('general-setting-update', [SettingController::class, 'generalSettingUpdate'])->name('general-setting-update');

// Home page setting routes
Route::get('home-page-setting', [HomePageSettingController::class, 'index'])->name('home-page-setting.index');
Route::put('popular-category-section', [HomePageSettingController::class, 'update'])->name('popular-category-section.update');

// Payment setting route
Route::get('payment-setting', [PaymentSettingController::class, 'index'])->name('payment-setting.index');
Route::resource('paypal-setting', PaypalSettingController::class);
Route::put('stripe-setting/{stripe_setting}', [StripeSettingController::class, 'update'])->name('stripe-setting.update');
Route::put('razor-setting/{razor_setting}', [RazorpaySettingController::class, 'update'])->name('razorpay-setting.update');
