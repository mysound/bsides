<?php

namespace App\Http\Controllers;

use App\Product;
use Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
    	return view('store.cart');
    }

    public function store(Request $request)
    {
    	$product = Product::find($request->product_id);
        $id = $product->id;
        if(!Cart::count()) {
            Cart::add($product->id, $product->title, 1, $product->price)
                ->associate('App\Product');
        } else {
            $item = Cart::search(function ($cartItem, $rowId) use ($id){
                return $cartItem->id === $id;
            });
            if($item->isEmpty()) {
                Cart::add($product->id, $product->title, 1, $product->price)
                    ->associate('App\Product');
            }
        }

    	return redirect()->route('cart')->with('message', 'Това был добавлен в Корзину!');
    }

    public function empty()
    {
        Cart::destroy();

        return redirect()->route('store')->with('message', 'Ваша Корзина пуста');
    }

    public function destroy($id)
    {
    	Cart::remove($id);

        if(Cart::count()) {
            return redirect()->route('cart')->with('message', 'Товар удален из Корзины');
        }

        return redirect()->route('store')->with('message', 'Ваша Корзина пуста');
    }
}
