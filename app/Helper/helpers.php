<?php

use App\Models\GeneralSetting;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

/**
 * Set sidebar item active
 */

function setActive(array $routes)
{
    if (is_array($routes)) {
        foreach ($routes as $route) {
            if (request()->routeIs($route)) {
                return 'active';
            }
        }
    }
}

/**
 * Check if product have discount
 */

function checkDiscount($product)
{
    $currentDate        =       Date('Y-m-d');

    if ($product->offer_price > 0  && $currentDate >= $product->offer_start_date && $currentDate <= $product->offer_end_date) {
        return true;
    }
    return false;
}

/**
 * Calculate discount percentage
 */

function calculateDiscount($originalPrice, $discountPrice)
{
    $discountAmount     =   $originalPrice - $discountPrice;
    $percentage         =   ($discountAmount / $originalPrice) * 100;
    return round($percentage);
}

/**
 *  Check product type
 */

function productType($type)
{
    switch ($type) {
        case 'new_arrival':
            return 'New';
            break;
        case 'featured_product':
            return 'Featured';
            break;
        case 'top_product':
            return 'Top';
            break;
        case 'best_product':
            return 'Best';
            break;

        default:
            return '';
            break;
    }
}

/**
 * Get cart sub total amount
 */
function getCartTotal()
{
    $total      =        0;
    foreach (Cart::content() as $product) {
        $total      +=      ($product->price + $product->options->variants_total) * $product->qty;
    }
    return $total;
}

// After applying coupon or on checkout page following function will return the total payable amount
function getTotalPayable()
{
    if (Session::has('coupon')) {
        $coupon     =       Session::get('coupon');
        $subTotal   =       getCartTotal();

        if ($coupon['discount_type'] == 'amount') {
            $total      =       $subTotal  - $coupon['discount'];
            return $total;
        } else if ($coupon['discount_type'] == 'percentage') {
            $discount   =       $subTotal  - ($subTotal  * $coupon['discount'] / 100);
            $total      =       $subTotal  - $discount;
            return $total;
        }
    } else {
        return getCartTotal();
    }
}

// This function will return coupon amount
function getCouponDiscount()
{
    if (Session::has('coupon')) {
        $coupon     =       Session::get('coupon');
        $subTotal   =       getCartTotal();
        if ($coupon['discount_type'] == 'amount') {
            return $coupon['discount'];
        } else if ($coupon['discount_type'] == 'percentage') {
            $discount   =       $subTotal  - ($subTotal  * $coupon['discount'] / 100);
            return ceil($discount);
        }
    } else {
        return 0;
    }
}

// Get shipping fee from session as we have stored in the session all the details of the shipping
function getShippingFee()
{
    if (Session::has('shipping_rule')) {
        return Session::get('shipping_rule')['cost'];
    } else {
        return 0;
    }
}

// Get the final payable amount the payment page
function getFinalPayableAmount()
{
    return getTotalPayable() + getShippingFee();
}

// Limit text
function limitText($text, $limit = 20)
{
    return Str::limit($text, $limit, '...');
}


// Get currency icon
function getCurrencyIcon()
{
    $icon       =       GeneralSetting::first();
    return $icon->currency_icon;
}
