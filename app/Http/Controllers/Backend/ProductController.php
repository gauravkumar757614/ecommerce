<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ProductImageGallery;
use App\Models\ProductVariant;
use App\Models\SubCategory;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories         =       Category::all();
        $sub_categories     =       SubCategory::all();
        $child_categories   =       ChildCategory::all();
        $brands             =       Brand::all();

        return view('admin.product.create', compact('categories', 'sub_categories', 'child_categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image'                 =>      ['required', 'image', 'max:3000'],
            'name'                  =>      ['required', 'max:200'],
            'category'              =>      ['required',],
            'brand'                 =>      ['required'],
            'price'                 =>      ['required'],
            'qty'                   =>      ['required'],
            'short_description'     =>      ['required', 'max:600'],
            'long_description'      =>      ['required'],
            'seo_title'             =>      ['nullable', 'max:200'],
            'seo_description'       =>      ['nullable', 'max:250'],
            'status'                =>      ['required']
        ]);

        $product        =       new Product();
        $file_path      =       $this->uploadImage($request, 'image', 'uploads');

        $product->name                  =       $request->name;
        $product->slug                  =       Str::slug($request->name);
        $product->thumb_image           =       $file_path;
        $product->vendor_id             =       Auth::user()->vendor->id;
        $product->category_id           =       $request->category;
        $product->sub_category_id       =       $request->sub_category;
        $product->child_category_id     =       $request->child_category;
        $product->brand_id              =       $request->brand;
        $product->qty                   =       $request->qty;
        $product->short_description     =       $request->short_description;
        $product->long_description      =       $request->long_description;
        $product->video_link            =       $request->video_link;
        $product->sku                   =       $request->sku;
        $product->price                 =       $request->price;
        $product->offer_price           =       $request->offer_price;
        $product->offer_start_date      =       $request->offer_start_date;
        $product->offer_end_date        =       $request->offer_end_date;
        $product->product_type          =       $request->product_type;
        $product->is_approved           =       1;
        $product->seo_title             =       $request->seo_title;
        $product->seo_description       =       $request->seo_description;
        $product->status                =       $request->status;
        $product->save();

        toastr('Create successfully!', 'success');
        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product            =       Product::findOrFail($id);
        $categories         =       Category::all();
        $sub_categories     =       SubCategory::where('category_id', $product->category_id)->get();
        $child_categories   =       ChildCategory::where('sub_category_id', $product->sub_category_id)->get();
        $brands             =       Brand::all();

        return view('admin.product.edit', compact('product', 'categories', 'sub_categories', 'child_categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image'                 =>      ['nullable', 'image', 'max:3000'],
            'name'                  =>      ['required', 'max:200'],
            'category'              =>      ['required',],
            'brand'                 =>      ['required'],
            'price'                 =>      ['required'],
            'qty'                   =>      ['required'],
            'short_description'     =>      ['required', 'max:600'],
            'long_description'      =>      ['required'],
            'seo_title'             =>      ['nullable', 'max:200'],
            'seo_description'       =>      ['nullable', 'max:250'],
            'status'                =>      ['required']
        ]);

        $product        =       Product::findOrFail($id);
        $file_path      =       $this->updateImage($request, 'image', 'uploads', $product->thumb_image);

        $product->name                  =       $request->name;
        $product->slug                  =       Str::slug($request->name);
        $product->thumb_image           =       empty(!$file_path) ? $file_path : $product->thumb_image;
        // $product->vendor_id             =       Auth::user()->vendor->id;
        $product->category_id           =       $request->category;
        $product->sub_category_id       =       $request->sub_category;
        $product->child_category_id     =       $request->child_category;
        $product->brand_id              =       $request->brand;
        $product->qty                   =       $request->qty;
        $product->short_description     =       $request->short_description;
        $product->long_description      =       $request->long_description;
        $product->video_link            =       $request->video_link;
        $product->sku                   =       $request->sku;
        $product->price                 =       $request->price;
        $product->offer_price           =       $request->offer_price;
        $product->offer_start_date      =       $request->offer_start_date;
        $product->offer_end_date        =       $request->offer_end_date;
        $product->product_type          =       $request->product_type;
        // $product->is_approved           =       1;
        $product->seo_title             =       $request->seo_title;
        $product->seo_description       =       $request->seo_description;
        $product->status                =       $request->status;
        $product->save();

        toastr('Updated successfully!', 'success');
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product                    =       Product::findOrFail($id);

        // Before deleting product checking this product has dependent orders
        if (OrderProduct::where('product_id', $product->id)->count() > 0) {
            return response(['status' => 'error', 'message' => ' Cannot be deleted! This product has dependent orders.']);
        }

        // Deleting image of the product
        $this->deleteImage($product->thumb_image);

        // Before deleting product, deleting its dependent product image gallery items
        $product_image_gallery      =       ProductImageGallery::where('product_id', $product->id)->get();
        foreach ($product_image_gallery as $product_images) {
            $this->deleteImage($product_images->image);
            $product_images->delete();
        }

        // Deleting product variants before product
        $variants                    =       ProductVariant::where('product_id', $product->id)->get();
        foreach ($variants as $variant) {
            $variant->productVariantItems()->delete();
            $variant->delete();
        }

        // Finally deleting the product
        $product->delete();
        return response(['status' => 'success', 'message' => 'deleted successfully!']);
    }

    /**
     * Change status of specific product in storage
     */
    public function changeStatus(Request $request)
    {
        $product               =       Product::findOrFail($request->id);
        $product->status       =       $request->status == 'true' ? 1 : 0;
        $product->save();
        return response(['message' => 'status has benn changed successfully!']);
    }


    /**
     * Fetching sub categories for selected main category from storage
     */
    public function getSubCategories(Request $request)
    {
        $sub_categories     =       SubCategory::where('category_id', $request->id)->get();
        return $sub_categories;
    }

    /**
     * Fetching child categories for selected sub category from storage
     */
    public function getChildCategories(Request $request)
    {
        $child_categories     =       ChildCategory::where('sub_category_id', $request->id)->get();
        return $child_categories;
    }
}
