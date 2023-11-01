<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use Illuminate\Support\Facades\Route;

// Profile Routes
Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
Route::get('profile', [ProfileController::class, 'index'])->name('profile');
Route::post('profile/update', [ProfileController::class, 'profileUpdate'])->name('profile.update');
Route::post('profile/update/password', [ProfileController::class, 'updatePassword'])->name('password.update');


// Slider Route
Route::resource('slider', SliderController::class);

// Creating a change status route in the resource controller
Route::put('change-status', [CategoryController::class, 'changeStatus'])->name('category.change-status');

// Category Route
Route::resource('category', CategoryController::class);


// Creating a change status route in the resource controller
Route::put('subcategory/change-status', [SubCategoryController::class, 'changeStatus'])->name('sub-category.change-status');

// Sub Category Route
Route::resource('sub-category', SubCategoryController::class);

// Creating a change status route in the resource controller
Route::put('child-category/change-status', [ChildCategoryController::class, 'changeStatus'])->name('child-category.change-status');
// Get all sub=categories related to selected main category route
Route::get('get-subcategories', [ChildCategoryController::class, 'getSubcategories'])->name('get-subcategories');
// Child Category Route
Route::resource('child-category', ChildCategoryController::class);
