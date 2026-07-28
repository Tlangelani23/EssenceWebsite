<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;

class CartController extends Controller
{
    public function add(Product $product)
    {
        $cart = Cart::where('product_id', $product->id)->first();

        if ($cart) {

            $cart->increment('quantity');

        } else {

            Cart::create([
                'product_id' => $product->id,
                'quantity' => 1,
            ]);

        }

        return redirect()->route('cart.index');
    }

    public function index()
    {
        $cartItems = Cart::with('product')->get();

        return view('shopping-bag', compact('cartItems'));
    }

     public function increase(Cart $cart)
    {
        $cart->increment('quantity');

        return back();
    }

    public function decrease(Cart $cart)
    {
        if ($cart->quantity > 1) {

            $cart->decrement('quantity');

        } else {

            $cart->delete();

        }

        return back();
    }

    public function remove(Cart $cart)
    {
        $cart->delete();

        return back();
    }
}
