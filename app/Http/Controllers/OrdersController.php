<?php

namespace App\Http\Controllers;

use App\Mail\NewOrder;
use App\Mail\UserOrder;
use Cart;
use App\User;
use App\Address;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class OrdersController extends Controller
{
    public function store(Request $request)
    {

    	$this->validate(request(), [
    		'email' => 'required|email',
            'last_name' => 'required',
            'first_name' => 'required',
            'phone' => 'required',
            'zip_code' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
            'g-recaptcha-response' => 'required|captcha'
    	]);

        $user = User::where('email', $request->email)->first();

        if(empty($user)) {
            $random_pas = Str::random(8);
            $user = new User;
            $user->name = $request->first_name;
            $user->email = $request->email;
            $user->password = bcrypt($random_pas);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;            
            $user->save();
        }       

        $address = $user->addresses()->firstOrCreate([
            'country_id' => 1,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'state' => $request->state,
            'city' => $request->city,
            'zip_code' => $request->zip_code,
            'phone' => $request->phone
        ]);


        $order = $this->newOrder($user->id, $address->id);

    	Mail::to(User::first())
            ->send(new NewOrder($order));

    	return redirect()->route('store')->with('message', 'Спасибо! Ваш заказ в обработке, в ближайшее время с Вами свяжится наш менеджер');
    }

    public function newOrder($user_id, $address_id)
    {

        $order = new Order;
        $order->user_id = $user_id;
        $order->address_id = $address_id;
        $order->comment = '';
        $order->shipping_address = '';
        $order->total = Cart::subtotal('2', '.', '');
        $order->subtotal = Cart::subtotal('2', '.', '');
        $order->total_tax = '0';
        $order->save();

        foreach (Cart::content() as $product) {
            $order->products()->attach($product->id, [
                'price' => $product->price,
                'quantity' => $product->qty
                ]
            );
        }

        Cart::destroy();

        return $order;
    }
}
