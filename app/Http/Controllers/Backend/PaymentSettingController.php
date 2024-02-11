<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PaypalSetting;
use App\Models\RazorpaySetting;
use App\Models\StripeSetting;
use Illuminate\Http\Request;

class PaymentSettingController extends Controller
{
    public function index()
    {
        $paypal         =       PaypalSetting::first();
        $stripe         =       StripeSetting::first();
        $razorpay       =       RazorpaySetting::first();
        return view('admin.payment-settings.index', compact('paypal', 'stripe', 'razorpay'));
    }
}
