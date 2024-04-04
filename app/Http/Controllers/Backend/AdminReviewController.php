<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\AdminReviewsDataTable;
use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class AdminReviewController extends Controller
{
    public function index(AdminReviewsDataTable $dataTable)
    {
        return $dataTable->render('admin.product.reviews.index');
    }

    public function changeStatus(Request $request)
    {
        $review               =       ProductReview::findOrFail($request->id);
        $review->status       =       $request->status == 'true' ? 1 : 0;
        $review->save();
        return response(['message' => 'status has benn changed successfully!']);
    }
}
