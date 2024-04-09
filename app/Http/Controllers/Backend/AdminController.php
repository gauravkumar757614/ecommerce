<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\NewsletterSubscriber;
use App\Models\Order;
use App\Models\ProductReview;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * This function will return login form for admin users
     */
    public function login()
    {
        return view('admin.auth.login');
    }

    public function dashboard()
    {
        $todaysOrders           =       Order::whereDate('created_at', Carbon::today())->count();

        $todaysPendingOrders    =       Order::whereDate('created_at', Carbon::today())
                                        ->where('order_status', 'pending')->count();

                                        $totalOrders            =       Order::count();
        $totalPendingOrders     =       Order::where('order_status', 'pending')->count();

        $totalCanceledOrders    =       Order::where('order_status', 'canceled')->count();

        $totalCompletedOrders   =       Order::where('order_status', 'delivered')->count();
        // $totalProducts          =       Product::where('vendor_id', Auth::user()->vendor->id)->count();

        $todaysEarnings         =       Order::whereDate('created_at', Carbon::today())
                                            ->where('payment_status', 1)
                                            ->where('order_status','!=' ,'canceled')
                                            ->sum('subtotal');

        $thisMonthEarnings      =       Order::whereMonth('created_at', Carbon::now()->month)
                                            ->where('payment_status', 1)
                                            ->where('order_status', '!=' ,'canceled')
                                            ->sum('subtotal');

        $thisYearEarnings       =       Order::whereYear('created_at', Carbon::now()->year)
                                            ->where('payment_status', 1)
                                            ->where('order_status', '!=' ,'canceled')
                                            ->sum('subtotal');

        // $totalEarnings          =       Order::where('order_status', 'delivered')
        //                                     ->whereHas('orderProducts', function ($query) {
        //                                     $query->where('vendor_id', Auth::user()->vendor->id);
        //                                 })->sum('amount');
        $totalReviews           =       ProductReview::count();
        $totalBrands            =       Brand::count();
        $totalCategories        =       Category::count();
        $totalBlogs             =       Blog::count();
        $totalSubscribers       =       NewsletterSubscriber::count();
        $totalVendors           =       User::where('role','vendor')->count();
        $totalUsers             =       User::where('role','user')->count();

        return view(
            'admin.dashboard',
            compact(
                'todaysOrders',
                'todaysPendingOrders',
                 'totalOrders',
                'totalPendingOrders',
                'totalCanceledOrders',
                'totalCompletedOrders',
                // 'totalProducts',
                'todaysEarnings',
                'thisMonthEarnings',
                'thisYearEarnings',
                // 'totalEarnings',
                'totalReviews',
                'totalBrands',
                'totalCategories',
                'totalBlogs',
                'totalSubscribers',
                'totalVendors',
                'totalUsers',


            )
        );
    }
}
