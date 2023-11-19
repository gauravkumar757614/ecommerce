<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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
