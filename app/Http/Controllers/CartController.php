<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function add_to_cart(Product $product, Request $request)
    {
      $user_id = Auth::id();
      $product_id = $product->id;

      $existing_cart = Cart::where('product_id', $product_id)
                            ->where('user_id', $user_id)
                            ->first();
      if($existing_cart == null) {

          $request->validate([
            'amount' => 'required | gte:1 | lte:'.$product->stock,
          ]);


          Cart::create([
            'user_id' => $user_id,
            'product_id' => $product_id,
            'amount' => $request->amount
          ]);
      }else {
        $request->validate([
            'amount' => 'required | gte:1 | lte:'.($product->stock - $existing_cart->amount),
          ]);

        $existing_cart->update([
            'amount' => $existing_cart->amount + $request->amount
        ]);
      }

      return Redirect::route('product.index');
    }

    public function show()
    {
        $user_id = Auth::id();
        $carts = Cart::where('user_id', $user_id)->get();
        return view('cart.show', compact('carts'));
    }

    public function edit(Cart $cart, Request $request)
    {
        $request->validate([
            'amount' => 'required|gte:1|lte:'.$cart->product->stock
        ]);
        $cart->update([
            'amount' => $request->amount
        ]);

        return Redirect::route('show_cart');
    }

    public function hapus(Cart $cart) {
        $cart->delete();
        return Redirect::back();
    }
}
