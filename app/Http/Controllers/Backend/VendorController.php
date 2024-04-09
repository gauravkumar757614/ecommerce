<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    public function dashboard()
    {
        $todaysOrders           =       Order::whereDate('created_at', Carbon::today())
                                        ->whereHas('orderProducts', function ($query) {
                                            $query->where('vendor_id', Auth::user()->vendor->id);
                                        })->count();

        $todaysPendingOrders    =       Order::whereDate('created_at', Carbon::today())
                                        ->where('order_status', 'pending')
                                        ->whereHas('orderProducts', function ($query) {
                                            $query->where('vendor_id', Auth::user()->vendor->id);
                                        })->count();
        $totalOrders            =       Order::whereHas('orderProducts', function ($query) {
                                            $query->where('vendor_id', Auth::user()->vendor->id);
                                        })->count();

        $totalPendingOrders     =       Order::where('order_status', 'pending')
                                        ->whereHas('orderProducts', function ($query) {
                                            $query->where('vendor_id', Auth::user()->vendor->id);
                                        })->count();

        $totalCompletedOrders   =       Order::where('order_status', 'delivered')
                                        ->whereHas('orderProducts', function ($query) {
                                            $query->where('vendor_id', Auth::user()->vendor->id);
                                        })->count();

        $totalProducts          =       Product::where('vendor_id', Auth::user()->vendor->id)->count();

        $todaysEarnings         =       Order::whereDate('created_at', Carbon::today())
                                            ->where('payment_status', 1)
                                            ->where('order_status', 'delivered')
                                            ->whereHas('orderProducts', function ($query) {
                                            $query->where('vendor_id', Auth::user()->vendor->id);
                                        })->sum('subtotal');

        $thisMonthEarnings      =       Order::whereMonth('created_at', Carbon::now()->month)
                                            ->where('payment_status', 1)
                                            ->where('order_status', 'delivered')
                                            ->whereHas('orderProducts', function ($query) {
                                            $query->where('vendor_id', Auth::user()->vendor->id);
                                        })->sum('subtotal');

        $thisYearEarnings       =       Order::whereYear('created_at', Carbon::now()->year)
                                            ->where('payment_status', 1)
                                            ->where('order_status', 'delivered')
                                            ->whereHas('orderProducts', function ($query) {
                                            $query->where('vendor_id', Auth::user()->vendor->id);
                                        })->sum('subtotal');

        $totalEarnings          =       Order::where('order_status', 'delivered')
                                            ->where('payment_status', 1)
                                            ->whereHas('orderProducts', function ($query) {
                                            $query->where('vendor_id', Auth::user()->vendor->id);
                                        })->sum('subtotal');

        $totalReviews           =       ProductReview::whereHas('product', function($query){
                                            $query->where('vendor_id', Auth::user()->vendor->id);
                                        })->count();

        return view(
            'vendor.dashboard.dashboard',
            compact(
                'todaysOrders',
                'todaysPendingOrders',
                'totalOrders',
                'totalPendingOrders',
                'totalCompletedOrders',
                'totalProducts',
                'todaysEarnings',
                'thisMonthEarnings',
                'thisYearEarnings',
                'totalEarnings',
                'totalReviews'
            )
        );
    }
}
