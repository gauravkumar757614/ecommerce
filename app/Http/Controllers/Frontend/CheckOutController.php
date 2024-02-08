<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ShippingRule;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckOutController extends Controller
{
    /**
     * Return view of the checkout page
     */
    public function index()
    {
        $addresses          =       UserAddress::where('user_id', Auth::user()->id)->get();
        $shippingMethods    =       ShippingRule::where('status', 1)->get();
        return view('frontend.pages.checkout', compact('addresses', 'shippingMethods'));
    }

    /**
     * Add a new address of current user
     */
    public function createAddress(Request $request)
    {
        $request->validate([
            'name'      =>       ['required', 'max:200'],
            'email'     =>       ['required', 'email'],
            'phone'     =>       ['required'],
            'country'   =>       ['required', 'max:200'],
            'state'     =>       ['required', 'max:200'],
            'city'      =>       ['required', 'max:200'],
            'zip'       =>       ['required', 'max:200'],
            'address'   =>       ['required'],
        ]);

        $address            =       new UserAddress();

        $address->user_id   =       Auth::user()->id;
        $address->name      =       $request->name;
        $address->email     =       $request->email;
        $address->phone     =       $request->phone;
        $address->country   =       $request->country;
        $address->state     =       $request->state;
        $address->city      =       $request->city;
        $address->zip       =       $request->zip;
        $address->address   =       $request->address;
        $address->save();

        toastr('Created Successfully!', 'success');
        return redirect()->back();
    }

    /**
     *
     */
    public function checkoutFormSubmit(Request $request)
    {
        $request->validate([
            'shipping_method_id'        =>       ['required', 'integer'],
            'shipping_address_id'       =>       ['required', 'integer'],
        ]);

        $shippingMethod         =       ShippingRule::findOrFail($request->shipping_method_id);
        if ($shippingMethod) {
            Session::put('shipping_rule', [
                'id'            =>      $shippingMethod->id,
                'name'          =>      $shippingMethod->name,
                'type'          =>      $shippingMethod->type,
                'cost'          =>      $shippingMethod->cost
            ]);
        }

        $userAddresses          =       UserAddress::findOrFail($request->shipping_address_id)->toArray();
        if ($userAddresses) {
            Session::put('address', $userAddresses);
        }

        return response(['status' => 'success', 'redirect_url' => route('user.payment.index')]);
    }
}
