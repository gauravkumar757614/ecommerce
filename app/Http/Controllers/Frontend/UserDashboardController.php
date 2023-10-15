<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    /**
     * This function returns the view of the user dashboard
     */
    public function index()
    {
        return view('frontend.dashboard.dashboard');
    }


}
