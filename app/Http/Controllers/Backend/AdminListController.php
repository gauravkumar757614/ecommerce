<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\AdminListDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;

class AdminListController extends Controller
{
    public function index(AdminListDataTable $dataTable)
    {
        return $dataTable->render('admin.admin-list.index');
    }

    public function changeStatus(Request $request)
    {
        $user               =       User::findOrFail($request->id);
        $user->status       =       $request->status == 'true' ? 'active' : 'inactive';
        $user->save();
        return response(['message' => 'status has been changed successfully!']);
    }

    public function destroy(string $id)
    {
        $admin              =       User::findOrFail($id);
        // Finding created products by this admin before deleting
        $products           =       Product::where('vendor_id', $admin->vendor->id)->get();

        if (count($products) > 0) {
            return response([
                'status' => 'error',
                'message' => 'This admin can\'t be deleted ban this admin instead'
            ]);
        }

        // Now if admin doest have dependent relation in the website delete it
        // first delete vendor profile
        Vendor::where('user_id', $admin->id)->delete();
        // Finally delete admin
        $admin->delete();
        return response(['status' => 'success', 'message' => 'Admin deleted successfully!']);
    }
}
