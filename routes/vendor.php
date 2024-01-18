<?php

use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\VendorProductImageGalleryController;
use App\Http\Controllers\Backend\VendorProductVariantController;
use App\Http\Controllers\Backend\VendorProfileController;
use App\Http\Controllers\Backend\VendorShopProfileController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', [VendorController::class, 'dashboard'])->name('dashboard');
Route::get('profile', [VendorProfileController::class, 'index'])->name('profile');
Route::put('profile', [vendorProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('profile', [vendorProfileController::class, 'updatePassword'])->name('profile.update.password');

// Vendor shop profile routes
Route::resource('shop-profile', VendorShopProfileController::class);


// Fetching related categories according to the selected one
Route::get('product/get-subcategories', [VendorProductController::class, 'getSubCategories'])->name('product.get-subcategories');
Route::get('product/get-child-categories', [VendorProductController::class, 'getChildCategories'])->name('product.get-child-categories');
Route::put('products/change-status', [VendorProductController::class, 'changeStatus'])->name('products.change-status');
// Vendor product routes
Route::resource('products', VendorProductController::class);

// Products image gallery routes
Route::resource('products-image-gallery', VendorProductImageGalleryController::class);

// Creating a change status route in the resource controller
Route::put('products-variant/change-status', [VendorProductVariantController::class, 'changeStatus'])->name('products-variant.change-status');
// Products variant routes
Route::resource('products-variant', VendorProductVariantController::class);

// Product variant item routes
// Route::get('products-variant-item/{productId}/{variantId}', [ProductVariantItemController::class, 'index'])->name('products-variant-item.index');
// Route::get('products-variant-item/create/{productId}/{variantId}', [ProductVariantItemController::class, 'create'])->name('products-variant-item.create');
// Route::post('products-variant-item', [ProductVariantItemController::class, 'store'])->name('products-variant-item.store');
// Route::get('products-variant-item-edit/{variantItemId}', [ProductVariantItemController::class, 'edit'])->name('products-variant-item.edit');
// Route::put('products-variant-item-update/{variantItemId}', [ProductVariantItemController::class, 'update'])->name('products-variant-item.update');
// Route::delete('products-variant-item/{variantItemId}', [ProductVariantItemController::class, 'destroy'])->name('products-variant-item.destroy');
// Route::put('products-variant-item/change-status}', [ProductVariantItemController::class, 'changeStatus'])->name('products-variant-item.change-status');
