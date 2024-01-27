<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Add to cart
     */
    public function addToCart(Request $request)
    {
        $product        =       Product::findOrFail($request->product_id);
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
     * Product details present in the cart
     */
    public function cartDetail()
    {
        $cartItems      =       Cart::content();
        return view('frontend.pages.cart-detail', compact('cartItems'));
    }

    /**
     * Update product quantity
     */
    public function updateQuantity(Request $request)
    {
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
        return redirect()->back();
    }

    /**
     * Get the total product count in the cart
     */
    public function getCartCount()
    {
        return Cart::content()->count();
    }
}
