<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\PaypalSetting;
use App\Models\Product;
use App\Models\StripeSetting;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Stripe\Stripe;
use Gloudemans\Shoppingcart\Facades\Cart;

// paypal class namespace
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Stripe\Charge;

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
     * Return the view when the payment successfull
     */
    public function paymentSuccess()
    {
        return view('frontend.pages.payment-success');
    }

    /**
     * Store order details
     */
    public function storeOrder($paymentMethod, $paymentStatus, $transactionId, $paidAmount, $paidCurrencyName)
    {
        $order                  =       new Order();
        $settings               =       GeneralSetting::first();
        $order->invoice_id      =       rand(1, 999999);
        $order->user_id         =       Auth::user()->id;
        $order->subtotal        =       getCartTotal();
        $order->amount          =       getFinalPayableAmount();
        $order->currency_name   =       $settings->currency_name;
        $order->currency_icon   =       $settings->currency_icon;
        $order->product_qty     =       Cart::content()->count();
        $order->payment_method  =       $paymentMethod;
        $order->payment_status  =       $paymentStatus;
        $order->order_address   =       json_encode(Session::get('address'));
        $order->shipping_method =       json_encode(Session::get('shipping_rule'));
        $order->coupon          =       json_encode(Session::get('coupon'));
        $order->order_status    =       0;

        $order->save();

        // store order_product details
        foreach (Cart::content() as $item) {
            $orderProduct                   =       new OrderProduct();
            $product                        =       Product::find($item->id);

            $orderProduct->order_id         =       $order->id;
            $orderProduct->product_id       =       $product->id;
            $orderProduct->vendor_id        =       $product->vendor_id;
            $orderProduct->product_name     =       $product->name;
            $orderProduct->variants         =       json_encode($item->options->variants);
            $orderProduct->variant_total    =       $item->options->variants_total;
            $orderProduct->unit_price       =       $item->price;
            $orderProduct->qty              =       $item->qty;
            $orderProduct->save();
        }

        // store transaction details
        $transaction                    =       new Transaction();
        $transaction->order_id          =       $order->id;
        $transaction->transaction_id    =       $transactionId;
        $transaction->payment_method    =       $paymentMethod;
        $transaction->amount            =       getFinalPayableAmount();
        $transaction->amount_real_currency      =   $paidAmount;
        $transaction->amount_real_currency_name =   $paidCurrencyName;
        $transaction->save();
    }

    /**
     * After storing order, order_product, trasaction flushing all session
     */
    public function clearSession()
    {
        Cart::destroy();
        Session::forget('address');
        Session::forget('shipping_rule');
        Session::forget('coupon');
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
        $paypalSetting  =       PaypalSetting::first();
        $config         =       $this->paypalConfig();

        $provider       =       new PayPalClient($config);
        $provider->getAccessToken();

        // calculate payable amount depending on the currency rate
        $total          =       getFinalPayableAmount();
        $payableAmount  =       round($total * $paypalSetting->currency_rate, 2);

        $response       =       $provider->createOrder([
            "intent"  =>    "CAPTURE",
            "application_context"        =>        [
                "return_url"        =>    route('user.paypal.success'),
                "cancel_url"        =>    route('user.paypal.cancel'),
            ],

            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => $config['currency'],
                        "value" => $payableAmount
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        } else {
            return redirect()->route('user.paypal.cancel');
        }
    }


    /**
     * When the payment is successfully
     */
    public function paypalSuccess(Request $request)
    {
        $config         =       $this->paypalConfig();
        $provider       =       new PayPalClient($config);
        $provider->getAccessToken();

        $response       =       $provider->capturePaymentOrder($request->token);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

            $paypalSetting  =       PaypalSetting::first();
            // calculate payable amount depending on the currency rate
            $total          =       getFinalPayableAmount();
            $paidAmount     =       round($total * $paypalSetting->currency_rate, 2);

            $this->storeOrder('paypal', 1, $response['id'], $paidAmount, $paypalSetting->currency_name);
            $this->clearSession();
            return redirect()->route('user.payment.success');
        }
        return redirect()->route('user.paypal.cancel');
    }

    /**
     * When the payment cancel return view
     */
    public function paypalCancel()
    {
        toastr('Something went wrong!', 'error', 'Error');
        return redirect()->route('user.payment.index');
    }


    /**
     * Stripe payment functions start
     */

    public function payWithStripe(Request $request)
    {
        $stripeSetting      =       StripeSetting::first();

        // calculate payable amount depending on the currency rate
        $total          =       getFinalPayableAmount();
        $payableAmount  =       round($total * $stripeSetting->currency_rate, 2);

        Stripe::setApiKey($stripeSetting->secret_key);
        $response       =       Charge::create([
            "amount"       =>      $payableAmount * 100,
            "currency"     =>      $stripeSetting->currency_name,
            "source"       =>      $request->stripe_token,
            "description"  =>      "Product purchased!",
        ]);
        if ($response->status === 'succeeded') {
            $this->storeOrder('stripe', 1, $response->id, $payableAmount, $stripeSetting->currency_name);
            // clearSession function will clear the cart and all the session when the payment is successfull
            $this->clearSession();
            return redirect()->route('user.payment.success');
        } else {
            toastr('Something went wrong!', 'error', 'Error');
            return redirect()->route('user.payment.index');
        }
    }


    /**
     * Pay with razorpay gateway
     */
    public function payWithRazorpay(Request $request)
    {
        dd($request->all());
    }
}
