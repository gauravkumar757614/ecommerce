<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PaypalSetting;
use Illuminate\Http\Request;

class PaymentSettingController extends Controller
{
    public function index()
    {
        $payment        =       PaypalSetting::first();
        return view('admin.payment-settings.index', compact('payment'));
    }
}