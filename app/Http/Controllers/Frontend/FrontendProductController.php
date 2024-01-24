<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendProductController extends Controller
{
    // Show product details page
    public function showDetails(String $slug)
    {
        $product    =   Product::with(['brand', 'variants', 'productImageGallery', 'category', 'vendor'])
                        ->where('slug', $slug)->where('status', 1)->first();
        return view('frontend.pages.product-details', compact('product'));
    }
}
