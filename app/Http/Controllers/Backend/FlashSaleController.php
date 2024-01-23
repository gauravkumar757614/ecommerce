<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FlashSaleItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\Product;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
{
    public function index(FlashSaleItemDataTable $dataTable)
    {
        $saleDate   =   FlashSale::first();
        $products   =   Product::where('is_approved', 1)->where('status', 1)->orderBy('id', 'DESC')->get();
        return $dataTable->render('admin.flash-sale.index', compact('saleDate', 'products'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'end_date'      =>      ['required']
        ]);

        FlashSale::updateOrCreate(
            ['id'    =>      1],
            ['end_date'     =>      $request->end_date]
        );

        toastr('Updated Successfull!', 'success');
        return redirect()->back();
    }

    public function addProduct(Request $request)
    {
        $request->validate(
            [
                'product'               =>      ['required', 'unique:flash_sale_items,product_id'],
                'show_at_home'          =>      ['required'],
                'status'                =>      ['required'],
            ],
            [
                'product.unique'        =>      'The product is already in the flash sale',
            ]
        );

        $flashSaleDate  =   FlashSale::first();
        $flashSale      =   new FlashSaleItem();
        $flashSale->product_id      =       $request->product;
        $flashSale->flash_sale_id   =       $flashSaleDate->id;
        $flashSale->show_at_home    =       $request->show_at_home;
        $flashSale->status          =       $request->status;
        $flashSale->save();

        toastr('Product Added Successfull!', 'success');
        return redirect()->back();
    }

    public function changeShowAtHomeStatus(Request $request)
    {
        $flashSaleItem                   =       FlashSaleItem::findOrFail($request->id);
        $flashSaleItem->show_at_home     =       $request->status == 'true' ? 1 : 0;
        $flashSaleItem->save();
        return response(['message' => 'status updated successfully!']);
    }

    public function changeStatus(Request $request)
    {
        $flashSaleItem             =       FlashSaleItem::findOrFail($request->id);
        $flashSaleItem->status     =       $request->status == 'true' ? 1 : 0;
        $flashSaleItem->save();
        return response(['message' => 'status updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $flashSaleItem     =       FlashSaleItem::findOrFail($id);
        $flashSaleItem->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}
