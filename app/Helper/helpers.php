<?php

use Gloudemans\Shoppingcart\Facades\Cart;
use PhpParser\Node\Expr\Cast\String_;

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
    return ceil($percentage);
}

/**
 *  Check product type
 */

function productType(string $type): String
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
 * Get cart total amount
 */
function getCartTotal()
{
    $total      =        0;
    foreach (Cart::content() as $product) {
        $total      +=      ($product->price + $product->options->variants_total) * $product->qty;
    }
    return $total;
}
