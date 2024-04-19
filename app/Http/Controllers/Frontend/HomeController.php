<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Advertisement;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\HomePageSetting;
use App\Models\Product;
use App\Models\Slider;
use App\Models\SubCategory;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;

class HomeController extends Controller
{
    public function index()
    {
        $sliders                =       Cache::rememberForever('sliders', function(){
                                            return Slider::where('status', 1)->orderBy('serial', 'asc')->get();
                                        });

        $flashSaleDate          =       FlashSale::first();

        $flashSaleItems         =       FlashSaleItem::where('show_at_home', 1)->where('status', 1)->pluck('product_id')->toArray();

        $popularCategory        =       HomePageSetting::where('key', 'popular_category_section')->first();

        $brands                 =       Brand::where('status', 1)->where('is_featured', 1)->get();

        $typeBaseProducts       =       $this->getTypeBaseProduct();

        // Category queries
        $categoryProductSliderSectionOne        =       HomePageSetting::where('key', 'product_slider_section_one')->first();
        $categoryProductSliderSectionTwo        =       HomePageSetting::where('key', 'product_slider_section_two')->first();
        $categoryProductSliderSectionThree      =       HomePageSetting::where('key', 'product_slider_section_three')->first();

        // Banner's queries
        $banner_one             =       Advertisement::where('key', 'homepage_banner_section_one')->first();
        $banner_two             =       Advertisement::where('key', 'homepage_banner_section_two')->first();
        $banner_three           =       Advertisement::where('key', 'homepage_banner_section_three')->first();
        $banner_four            =       Advertisement::where('key', 'homepage_banner_section_four')->first();

        $banner_one_content     =       json_decode($banner_one?->value,    true);
        $banner_two_content     =       json_decode($banner_two?->value,    true);
        $banner_three_content   =       json_decode($banner_three?->value,  true);
        $banner_four_content    =       json_decode($banner_four?->value,   true);

        // Blogs
        $blogs                  =       Blog::with(['category', 'user'])->where('status', 1)->orderBy('id', 'desc')->take(8)->get();

        return view(
            'frontend.home.home',
            compact(
                'sliders',
                'flashSaleDate',
                'flashSaleItems',
                'popularCategory',
                'brands',
                'typeBaseProducts',
                'categoryProductSliderSectionOne',
                'categoryProductSliderSectionTwo',
                'categoryProductSliderSectionThree',
                'banner_one_content',
                'banner_two_content',
                'banner_three_content',
                'banner_four_content',
                'blogs'
            )
        );
    }

    public function getTypeBaseProduct()
    {
        $typeBaseProduct        =       [];
        $typeBaseProduct['new_arrival']             =       Product::withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->with(['category', 'variants', 'productImageGallery'])
            ->where(['product_type' => 'new_arrival', 'is_approved' => 1, 'status' => 1])
            ->orderBy('id', 'desc')
            ->take(8)
            ->get();

        $typeBaseProduct['featured_product']        =       Product::withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->with(['category', 'variants', 'productImageGallery'])
            ->where(['product_type' => 'featured_product', 'is_approved' => 1, 'status' => 1])
            ->orderBy('id', 'desc')
            ->take(8)
            ->get();

        $typeBaseProduct['top_product']             =       Product::withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->with(['category', 'variants', 'productImageGallery'])
            ->where(['product_type' => 'top_product', 'is_approved' => 1, 'status' => 1])
            ->orderBy('id', 'desc')
            ->take(8)
            ->get();

        $typeBaseProduct['best_product']            =       Product::withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->with(['category', 'variants', 'productImageGallery'])
            ->where(['product_type' => 'best_product', 'is_approved' => 1, 'status' => 1])
            ->orderBy('id', 'desc')
            ->take(8)
            ->get();
        return $typeBaseProduct;
    }

    public function vendorPage()
    {
        $vendors        =       Vendor::where('status', 1)->paginate(20);
        return view('frontend.pages.vendor', compact('vendors'));
    }

    public function vendorProductsPage(string $id)
    {

        $products   =       Product::where([
            'status'        =>   1,
            'is_approved'   =>   1,
            'vendor_id'     =>  $id
        ])
            ->orderBy('id', 'desc')
            ->paginate(12);

        $categories     =       Category::where(['status' => 1])->get();
        $brands         =       Brand::where(['status' => 1])->get();
        $vendor         =       Vendor::findOrFail($id);
        return view('frontend.pages.vendor-products', compact('products', 'categories', 'brands', 'vendor'));
    }

    public function showProductModal(string $id)
    {
        $product        =       Product::findOrFail($id);
        $content        =       view('frontend.layouts.modal', compact('product'))->render();
        return Response::make($content, 200, ['Content-Type' => 'text/html']);
    }
}
