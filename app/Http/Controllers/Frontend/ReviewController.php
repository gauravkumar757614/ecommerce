<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\UserProductReviewsDataTable;
use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use App\Models\ProductReviewGallery;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    use ImageUploadTrait;

    public function index(UserProductReviewsDataTable $dataTable)
    {
        return $dataTable->render('frontend.dashboard.reviews.index');
    }

    public function create(Request $request)
    {
        $request->validate([
            'rating'        =>      ['required'],
            'review'        =>      ['required', 'max:200'],
            'image.*'       =>      ['nullable', 'image']
        ]);

        $existReview    =       ProductReview::where(['product_id' => $request->product_id, 'user_id' => Auth::user()->id])->first();
        if ($existReview) {
            toastr('Youh have already added a Review for this Product!', 'error', 'error');
            return redirect()->back();
        }

        $review         =       new ProductReview();
        $reviewGallery  =       new ProductReviewGallery();

        $imagePaths     =       $this->uploadMultipleImage($request, 'image', 'uploads');

        $review->product_id         =       $request->product_id;
        $review->user_id            =       Auth::user()->id;
        $review->vendor_id          =       $request->vendor_id;
        $review->rating             =       $request->rating;
        $review->review             =       $request->review;
        $review->status             =       0;
        $review->save();

        if (!empty($imagePaths)) {
            $imageData = [];
            foreach ($imagePaths as $path) {
                $data = [
                    'product_review_id'     =>          $review->id,
                    'image'                 =>          $path,
                    'created_at'            =>          now(),
                    'updated_at'            =>          now()
                ];
                $imageData[]    =   $data;
            }
        }
        ProductReviewGallery::insert($imageData);
        toastr('Review added successfully!', 'success', 'success');
        return redirect()->back();
    }
}
