<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    public function checkout(){
        $user_id = Auth::id();
        $carts = Cart::where('user_id', $user_id)->get();

        if($carts == null)
        {
            return Redirect::back();
        }

        $order = Order::create([
            'user_id' => $user_id,
        ]);

        foreach($carts as $cart)
        {
            $product = Product::find($cart->product_id);

            $product->update([
                'stock' => $product->stock - $cart->amount,
            ]);
            Transaction::create([
                'amount' => $cart->amount,
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
            ]);

            $cart->delete();
        }

        return Redirect::back();
    }
}
