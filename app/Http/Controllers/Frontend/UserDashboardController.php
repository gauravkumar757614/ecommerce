<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ProductReview;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    /**
     * This function returns the view of the user dashboard
     */
    public function index()
    {
        $totalOrders        =       Order::where('user_id', Auth::user()->id)->count();
        $penderOrders       =       Order::where('user_id', Auth::user()->id)
            ->where('order_status', 'pending')->count();
        $completedOrders    =       Order::where('user_id', Auth::user()->id)
            ->where('order_status', 'delivered')->count();
        $reviews            =       ProductReview::where('user_id', Auth::user()->id)->count();
        $wishlist           =       Wishlist::where('user_id', Auth::user()->id)->count();


        return view(
            'frontend.dashboard.dashboard',
            compact(
                'totalOrders',
                'penderOrders',
                'completedOrders',
                'reviews',
                'wishlist',
            )
        );
    }
}
