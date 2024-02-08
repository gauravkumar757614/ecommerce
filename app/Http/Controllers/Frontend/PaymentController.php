<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PaypalSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

// paypal class namespace
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentController extends Controller
{
    /**
     * Return view of payment gateway
     */
    public function index()
    {
        if (!Session::has('address')) {
            return redirect()->route('user.checkout.index');
        }
        return view('frontend.pages.payment');
    }

    /**
     * Paypal credentials config
     */
    public function paypalConfig()
    {
        $paypal             =       PaypalSetting::first();

        $config = [
            'mode'          =>      $paypal->mode == 1 ? 'live' : 'sandbox',

            'sandbox'       =>      [
                'client_id'         => $paypal->client_id,
                'client_secret'     => $paypal->secret_key,
                'app_id'            => 'APP-80W284485P519543T',
            ],
            'live'          =>      [
                'client_id'         => $paypal->client_id,
                'client_secret'     => $paypal->secret_key,
                'app_id'            => 'APP-80W284485P519543T',
            ],

            'payment_action' => 'Sale',
            'currency'       => $paypal->currency_name,
            'notify_url'     => 'https://your-app.com/paypal/notify',
            'locale'         => 'en_US',
            'validate_ssl'   => true,
        ];
        return $config;
    }

    /**
     * Pay with paypal
     */
    public function payWithPaypal(Request $request)
    {
        $config         =       $this->paypalConfig();
        $provider       =       new PayPalClient();
        $provider->setApiCredentials($config);

        $response       =       $provider->createProduct([
            "intent"  =>    "CAPTURE",
            "application_context"        =>        [
                "return_url"        =>    route('user.paypal.success'),
                "cancel_url"        =>    route('user.paypal.cancel'),
            ],

            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => $config['currency'],
                        "value" =>
                    ]
                ]
            ]
        ]);
    }
}
