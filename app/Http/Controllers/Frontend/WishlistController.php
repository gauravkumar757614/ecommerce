<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // Return all wish list products view
    public function index()
    {
        $wishlistProducts       =       Wishlist::with(['product'])->where('user_id', Auth::user()->id)
                                        ->orderBy('id', 'desc')->get();
        return view('frontend.pages.wishlist', compact('wishlistProducts'));
    }

    // Add product to wish list
    public function addToWishlist(Request $request)
    {
        $wishlist               =       new Wishlist();
        if (!Auth::check()) {
            return response(['status' => 'error', 'message' => 'You have to login first!']);
        }

        $wishlistCount          =       Wishlist::where(['product_id' => $request->id, 'user_id' => Auth::user()->id])->count();
        if ($wishlistCount > 0) {
            return response(['status' => 'error', 'message' => 'Product is already in the wish list']);
        }

        $wishlist->product_id   =       $request->id;
        $wishlist->user_id      =       Auth::user()->id;
        $wishlist->save();

        $count                  =       Wishlist::where('user_id', Auth::user()->id)->count();
        return response(['status' => 'success', 'message' => 'Product is added to wishlist', 'count' => $count]);
    }

    // Remove specific product from wishlist
    public function destroy(string $id)
    {
        $wishlistProduct       =       Wishlist::where('id', $id)->firstOrFail();
        if ($wishlistProduct->user_id !== Auth::user()->id) {
            return redirect()->back();
        }
        $wishlistProduct->delete();

        toastr('Product removed successfully!', 'success', 'success');
        return redirect()->back();
    }
}
