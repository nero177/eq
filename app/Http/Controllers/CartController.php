<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jackiedo\Cart\Cart;

class CartController extends Controller
{
    public function __construct(private Cart $cart)
    {
    }

    public function index(Request $request)
    {
        $items = $this->cart->getItems();

        return view('pages.cart', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'integer|required',
            'title' => 'required',
            'price' => 'integer|required',
        ]);

        $this->cart->addItem([
            'id' => $request->id,
            'title' => $request->title,
            'price' => $request->price,
            'extra_info' => [
                'type' => $request->type,
            ],
        ]);

        return redirect()->route('cart.view');
    }

    public function remove(Request $request)
    {
        $request->validate(['hash' => 'required']);

        $this->cart->removeItem($request->hash);

        return redirect()->route('cart.view');
    }

    public function removeAll(Request $request)
    {
        $this->cart->clearItems();

        return redirect()->route('cart.view');
    }

    public function updateQuantity(Request $request)
    {
        $request->validate(['hash' => 'required', 'quantity' => 'integer|required|min:1|max:10']);

        $this->cart->updateItem($request->hash, [
            'quantity' => $request->quantity
        ]);

        return redirect()->route('cart.view');
    }
}
