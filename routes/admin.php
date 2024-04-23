<?php

use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminListController;
use App\Http\Controllers\Backend\AdminReviewController;
use App\Http\Controllers\Backend\AdminVendorProfileController;
use App\Http\Controllers\Backend\AdvertisementController;
use App\Http\Controllers\Backend\BlogCategoryController;
use App\Http\Controllers\Backend\BlogCommentController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\CodSettingController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\CustomerListController;
use App\Http\Controllers\Backend\FlashSaleController;
use App\Http\Controllers\Backend\FooterGridThreeController;
use App\Http\Controllers\Backend\FooterGridTwoController;
use App\Http\Controllers\Backend\FooterInfoController;
use App\Http\Controllers\Backend\FooterSocialController;
use App\Http\Controllers\Backend\HomePageSettingController;
use App\Http\Controllers\Backend\ManageUserController;
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
use App\Http\Controllers\Backend\SubscriberController;
use App\Http\Controllers\Backend\TermsAndConditionsController;
use App\Http\Controllers\Backend\TransactionController;
use App\Http\Controllers\Backend\VendorConditionController;
use App\Http\Controllers\Backend\VendorListController;
use App\Http\Controllers\Backend\VendorRequestController;
use App\Http\Controllers\Backend\WithdrawController;
use App\Http\Controllers\Backend\WithdrawMethodController;
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

// Review routes
Route::get('reviews', [AdminReviewController::class, 'index'])->name('reviews.index');
Route::put('reviews/change-status', [AdminReviewController::class, 'changeStatus'])->name('reviews.change-status');

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
Route::put('email-configuration', [SettingController::class, 'emailConfiguration'])->name('email-configuration');
Route::put('logo-setting-update', [SettingController::class, 'logoSettingUpdate'])->name('logo-setting-update');
Route::put('pusher-setting-update', [SettingController::class, 'pusherSettingUpdate'])->name('pusher-setting-update');


// Home page setting routes
Route::get('home-page-setting', [HomePageSettingController::class, 'index'])->name('home-page-setting.index');
Route::put('popular-category-section', [HomePageSettingController::class, 'update'])->name('popular-category-section.update');
Route::put('product-slider-section-one', [HomePageSettingController::class, 'updateProductSliderSectionOone'])->name('product-slider-section-one.update');
Route::put('product-slider-section-two', [HomePageSettingController::class, 'updateProductSliderSectionOTwo'])->name('product-slider-section-two.update');
Route::put('product-slider-section-three', [HomePageSettingController::class, 'updateProductSliderSectionOThree'])->name('product-slider-section-three.update');

// Blog & related Category route
Route::put('blog-category/change-status', [BlogCategoryController::class, 'changeStatus'])->name('blog-category.change-status');
Route::resource('blog-category', BlogCategoryController::class);

Route::put('blog/change-status', [BlogController::class, 'changeStatus'])->name('blog.change-status');
Route::resource('blog', BlogController::class);

Route::get('blog-comments', [BlogCommentController::class, 'index'])->name('blog-comments.index');
Route::delete('blog-comment/{id}', [BlogCommentController::class, 'destroy'])->name('blog-comment.destroy');

// Footer routes
Route::resource('footer-info', FooterInfoController::class);

Route::put('footer-socials/change-status', [FooterSocialController::class, 'changeStatus'])->name('footer-socials.change-status');
Route::resource('footer-socials', FooterSocialController::class);

Route::put('footer-grid-two-change-status', [FooterGridTwoController::class, 'changeStatus'])->name('footer-grid-two.change-status');
Route::put('footer-grid-two-change-title', [FooterGridTwoController::class, 'changeTitle'])->name('footer-grid-two.change-title');
Route::resource('footer-grid-two', FooterGridTwoController::class);

Route::put('footer-grid-three/change-status', [FooterGridThreeController::class, 'changeStatus'])->name('footer-grid-three.change-status');
Route::put('footer-grid-three-change-title', [FooterGridThreeController::class, 'changeTitle'])->name('footer-grid-three.change-title');
Route::resource('footer-grid-three', FooterGridThreeController::class);

// Subscriber's routes
Route::get('subscribers', [SubscriberController::class, 'index'])->name('subscribers.index');
Route::delete('subscriber-destroy/{id}', [SubscriberController::class, 'destroy'])->name('subscriber.destroy');
Route::post('subscriber-send-mail', [SubscriberController::class, 'sendMail'])->name('subscriber-send-mail');

// Advertisement routes
Route::get('advertisement', [AdvertisementController::class, 'index'])->name('advertisement.index');
Route::put('advertisement/homepage-banner-section-one', [AdvertisementController::class, 'homepageBannerSectionOne'])->name('homepage-banner-section-one');
Route::put('advertisement/homepage-banner-section-two', [AdvertisementController::class, 'homepageBannerSectionTwo'])->name('homepage-banner-section-two');
Route::put('advertisement/homepage-banner-section-three', [AdvertisementController::class, 'homepageBannerSectionThree'])->name('homepage-banner-section-three');
Route::put('advertisement/homepage-banner-section-four', [AdvertisementController::class, 'homepageBannerSectionFour'])->name('homepage-banner-section-four');
Route::put('advertisement/productpage-banner', [AdvertisementController::class, 'productpageBanner'])->name('productpage-banner');
Route::put('advertisement/cartpage-banner', [AdvertisementController::class, 'cartpageBanner'])->name('cartpage-banner');

// Vendor request routes
Route::get('vendor-requests', [VendorRequestController::class, 'index'])->name('vendor-requests.index');
Route::get('vendor-requests/{id}/show', [VendorRequestController::class, 'show'])->name('vendor-requests.show');
Route::put('vendor-requests/{id}/change-status', [VendorRequestController::class, 'changeStatus'])->name('vendor-requests.change-status');

// Customer routes
Route::get('customers', [CustomerListController::class, 'index'])->name('customers.index');
Route::put('customers/change-status', [CustomerListController::class, 'changeStatus'])->name('customers.change-status');

// Admin list routes
Route::get('admin-list', [AdminListController::class, 'index'])->name('admin-list.index');
Route::put('admin-list/change-status', [AdminListController::class, 'changeStatus'])->name('admin-list.change-status');
Route::delete('admin-list/{id}', [AdminListController::class, 'destroy'])->name('admin-list.destroy');

// Manage users routes
Route::get('manage-user', [ManageUserController::class, 'index'])->name('manage-user.index');
Route::post('manage-user', [ManageUserController::class, 'create'])->name('manage-user.create');

// Vendor routes
Route::get('vendors-list', [VendorListController::class, 'index'])->name('vendors-list.index');
Route::put('vendors-list/change-status', [VendorListController::class, 'changeStatus'])->name('vendors-list.change-status');

Route::get('vendor-conditions', [VendorConditionController::class, 'index'])->name('vendor-conditions.index');
Route::put('vendor-conditions/update', [VendorConditionController::class, 'update'])->name('vendor-conditions.update');

Route::get('about', [AboutController::class, 'index'])->name('about.index');
Route::put('about/update', [AboutController::class, 'update'])->name('about.update');

// Terms and condition page routes
Route::get('terms-and-conditions', [TermsAndConditionsController::class, 'index'])->name('terms-and-conditions.index');
Route::put('terms-and-conditions/update', [TermsAndConditionsController::class, 'update'])->name('terms-and-conditions.update');


// Payment setting route
Route::get('payment-setting', [PaymentSettingController::class, 'index'])->name('payment-setting.index');
Route::resource('paypal-setting', PaypalSettingController::class);
Route::put('stripe-setting/{stripe_setting}', [StripeSettingController::class, 'update'])->name('stripe-setting.update');
Route::put('razor-setting/{razor_setting}', [RazorpaySettingController::class, 'update'])->name('razorpay-setting.update');
Route::put('cod-setting/{id}', [CodSettingController::class, 'update'])->name('cod-setting.update');

// Withdraw methods routes
Route::resource('withdraw-method', WithdrawMethodController::class);
// Withdraw list routes
Route::get('withdraw', [WithdrawController::class, 'index'])->name('withdraw.index');
Route::get('withdraw/{id}', [WithdrawController::class, 'show'])->name('withdraw.show');
Route::put('withdraw/{id}', [WithdrawController::class, 'update'])->name('withdraw.update');
