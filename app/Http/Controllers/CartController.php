<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart; 
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
public function index()
{
$user = Auth::user();
$cartItems = $user->cartItems;

return view('cart.index', compact('cartItems'));
}

public function add(Request $request)
{
$request->validate([
'product_id' => 'required|exists:products,id',
'quantity' => 'required|integer|min:1',
]);

$user = Auth::user();
$user->cartItems()->updateOrCreate(
['product_id' => $request->product_id],
['quantity' => $request->quantity]
);

return redirect()->route('cart.index')->with('success', 'Item added to cart.');
}

public function update(Request $request, Cart $cart)
{
$request->validate([
'quantity' => 'required|integer|min:1',
]);

$cart->update(['quantity' => $request->quantity]);

return redirect()->route('cart.index')->with('success', 'Cart updated.');
}

public function remove(Cart $cart)
{
$cart->delete();

return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
}

public function checkout()
{
    $user = Auth::user();
    $cartItems = $user->cartItems()->with('product')->get();

    if ($cartItems->isEmpty()) {
        return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
    }

    return view('cart.checkout', compact('cartItems'));
}
}
