<?php

namespace App\Http\Controllers\backend;

use App\DataTables\ProductVariantItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;
use PDO;

class ProductVariantItemController extends Controller
{
    /**
     * Return index view of product variant item
     */
    public function index(ProductVariantItemDataTable $dataTable, $productId, $variantId)
    {
        $product        =       Product::findOrFail($productId);
        $variant        =       ProductVariant::findOrFail($variantId);
        return $dataTable->render('admin.product.product-variant-item.index', compact('product', 'variant'));
    }

    /**
     * Return create view of product variant item
     */
    public function create(string $productId, string $variantId)
    {
        $product        =       Product::findOrFail($productId);
        $variant        =       ProductVariant::findOrFail($variantId);
        return view('admin.product.product-variant-item.create', compact('product', 'variant'));
    }

    /**
     * store a variant item in the storage
     */
    public function store(Request $request)
    {
        $request->validate([
            'variant_id'    =>      ['required',],
            'name'          =>      ['required', 'max:200'],
            'price'         =>      ['required',],
            'is_default'    =>      ['required'],
            'status'        =>      ['required']
        ]);

        $variant_item       =       new ProductVariantItem();

        $variant_item->product_variant_id       =       $request->variant_id;
        $variant_item->name                     =       $request->name;
        $variant_item->price                    =       $request->price;
        $variant_item->is_default               =       $request->is_default;
        $variant_item->status                   =       $request->status;

        $variant_item->save();

        toastr('Created Successfully!', 'success');
        return redirect()->route('admin.products-variant-item.index', ['productId' => $request->product, 'variantId' => $request->variant_id]);
    }

    /**
     * Return edit view of product variant item
     */
    public function edit(string $id)
    {
        $variant_item       =       ProductVariantItem::findOrFail($id);
        return view('admin.product.product-variant-item.edit', compact('variant_item'));
    }

    /**
     * Update specified variant item in the storage
     */
    public function update(String $id, Request $request)
    {
        $request->validate([
            'name'          =>      ['required', 'max:200'],
            'price'         =>      ['required',],
            'is_default'    =>      ['required'],
            'status'        =>      ['required']
        ]);

        $variant_item       =       ProductVariantItem::findOrFail($id);

        // $variant_item->product_variant_id       =       $request->variant_id;
        $variant_item->name                     =       $request->name;
        $variant_item->price                    =       $request->price;
        $variant_item->is_default               =       $request->is_default;
        $variant_item->status                   =       $request->status;

        $variant_item->save();

        toastr('Updated Successfully!', 'success');
        return redirect()->route('admin.products-variant-item.index', [
            'productId' => $variant_item->productVariant->product_id,
            'variantId' => $variant_item->product_variant_id
        ]);
    }

    /**
     * Destroy specific variant item from storage
     */
    public function destroy(string $id)
    {
        $variant_item       =       ProductVariantItem::findOrFail($id);
        $variant_item->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    /**
     * Change status of specific variant item in storage
     */
    public function changeStatus(Request $request)
    {
        $variant_item               =       ProductVariantItem::findOrFail($request->id);
        $variant_item->status       =       $request->status == 'true' ? 1 : 0;
        $variant_item->save();

        return response(['message' => 'status has been changed successfully!']);
    }
}
