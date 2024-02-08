<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    /**
     * Product details present in the cart
     */
    public function cartDetail()
    {
        $cartItems      =       Cart::content();
        if (count($cartItems) == 0) {
            // When cart is empty we are destroying all the coupons present in the session
            Session::forget('coupon');

            toastr('Cart cleared! Time to add some joyous items to your shopping list!', 'warning', 'Cart empty!');
            return redirect()->route('home');
        }
        return view('frontend.pages.cart-detail', compact('cartItems'));
    }

    /**
     * Add to cart
     */
    public function addToCart(Request $request)
    {
        $product        =       Product::findOrFail($request->product_id);

        // Before adding product to cart checking the inventory for product quantity
        if ($product->qty == 0) {
            return response(['status' => 'error', 'message' => 'Product out of stock']);
        } else if ($product->qty < $request->qty) {
            return response(['status' => 'error', 'message' => 'Request quantity is not available']);
        }

        $variants       =       [];
        $variantTotalAmount =   0;

        if ($request->has('variant_items')) {
            // Fetching all detail of the variants
            foreach ($request->variant_items as $id) {
                $variantItem                                                    =       ProductVariantItem::findOrFail($id);
                $variants[$variantItem->productVariant->name]['name']           =       $variantItem->name;
                $variants[$variantItem->productVariant->name]['price']          =       $variantItem->price;
                $variantTotalAmount                                             +=      $variantItem->price;
            }
        }

        // Check discount
        $productPrice = 0;
        if (checkDiscount($product)) {
            $productPrice     =  $product->offer_price;
        } else {
            $productPrice     =  $product->price;
        }

        $cartData   =   [];

        $cartData['id']                             =       $product->id;
        $cartData['name']                           =       $product->name;
        $cartData['qty']                            =       $request->qty;
        $cartData['price']                          =       $productPrice;
        $cartData['weight']                         =       10;
        $cartData['options']['variants']            =       $variants;
        $cartData['options']['variants_total']      =       $variantTotalAmount;
        $cartData['options']['image']               =       $product->thumb_image;
        $cartData['options']['slug']                =       $product->slug;
        Cart::add($cartData);
        return response(['status' => 'success', 'message' => 'Added To Cart Successfully!']);
    }

    /**
     * Update product quantity
     */
    public function updateQuantity(Request $request)
    {
        $productId      =       Cart::get($request->rowId)->id;
        $product        =       Product::findOrFail($productId);
        // dd($product);
        // Before adding product to cart checking the inventory for product quantity
        if ($product->qty == 0) {
            return response(['status' => 'error', 'message' => 'Product out of stock']);
        } else if ($product->qty < $request->qty) {
            return response(['status' => 'error', 'message' => 'Request quantity is not available']);
        }

        Cart::update($request->rowId, $request->quantity);
        $productTotal   =   $this->productTotal($request->rowId);
        return response([
            'status' => 'success', 'message' => 'Product quantity updated',
            'product_total' => $productTotal
        ]);
    }

    /**
     * Total amount of the product
     */
    public function productTotal($rowId)
    {
        $product        =       Cart::get($rowId);
        $total          =       ($product->price + $product->options->variants_total) * $product->qty;
        return $total;
    }

    /**
     * Get the total amount of all the product present in the cart
     */
    public function cartTotal()
    {
        $total      =        0;
        foreach (Cart::content() as $product) {
            $total      +=      $this->productTotal($product->rowId);
        }
        return $total;
    }

    /**
     * Clear cart data
     */
    public function clearCart()
    {
        Cart::destroy();
        return response(['status' => 'success', 'message' => 'Cart is cleared successfully!']);
    }

    /**
     * Remove a particular product from the cart
     */
    public function removeProduct($rowId)
    {
        Cart::remove($rowId);
        toastr('Product removed successfully!', 'success');
        return redirect()->back();
    }

    /**
     * Get the total product count in the cart
     */
    public function getCartCount()
    {
        return Cart::content()->count();
    }

    /**
     * Get all products in sidebar cart
     */
    public function getCartProducts()
    {
        return Cart::content();
    }

    /**
     * Remove particular product from sidebar
     */
    public function removeSidebarProduct(Request $request)
    {
        Cart::remove($request->rowId);
        return response(['statis' => 'success', 'message' => 'Product removed successfully!']);
    }

    /**
     * Apply coupon code
     */
    public function applyCoupon(Request $request)
    {
        // dd($request->all());
        if ($request->coupon_code === null) {
            return response(['status' => 'error', 'message' => 'Fill the coupon!']);
        }

        $coupon     =       Coupon::where(['code' => $request->coupon_code, 'status' => 1])->first();
        // dd($coupon);
        if ($coupon === null) {
            return response(['status' => 'error', 'message' => 'Coupon does not exists!']);
        } else if ($coupon->start_date > date('Y-m-d')) {
            return response(['status' => 'error', 'message' => 'Coupon does not exists!']);
        } else if ($coupon->end_date < date('Y-m-d')) {
            return response(['status' => 'error', 'message' => 'Coupon is expired!']);
        } else if ($coupon->total_used >= $coupon->quantity) {
            return response(['status' => 'error', 'message' => 'Coupon limit exceeded!']);
        }

        if ($coupon->discount_type == 'amount') {
            Session::put('coupon', [
                'coupon_name'       =>       $coupon->name,
                'coupon_code'       =>       $coupon->code,
                'discount_type'     =>       'amount',
                'discount'          =>       $coupon->discount,

            ]);
        } else if ($coupon->discount_type == 'percentage') {
            Session::put('coupon', [
                'coupon_name'       =>       $coupon->name,
                'coupon_code'       =>       $coupon->code,
                'discount_type'     =>       'percentage',
                'discount'          =>       $coupon->discount,

            ]);
        }

        return response(['status' => 'success', 'message' => 'Coupon applied successfully!']);
    }

    /**
     * Calculating the coupon amount
     */
    public function couponCalculation()
    {
        if (Session::has('coupon')) {
            $coupon     =       Session::get('coupon');
            $subTotal   =       getCartTotal();
            if ($coupon['discount_type'] == 'amount') {
                $total      =       $subTotal  - $coupon['discount'];
                return response(['status' => 'success', 'cart_total' => $total, 'discount' => $coupon['discount']]);
            } else if ($coupon['discount_type'] == 'percentage') {
                $discount   =       $subTotal  - ($subTotal  * $coupon['discount'] / 100);
                $total      =       $subTotal  - $discount;
                return response(['status' => 'success', 'cart_total' => $total, 'discount' => ceil($discount)]);
            }
        } else {
            $total      =       getCartTotal();
            return response(['status' => 'success', 'cart_total' => $total, 'discount' => 0]);
        }
    }
}
