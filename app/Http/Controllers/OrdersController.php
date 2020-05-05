<?php

namespace App\Http\Controllers;

use App\Mail\NewOrder;
use App\Mail\UserOrder;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

    	Mail::to(request('email'))
            ->send(new NewOrder());

        Cart::destroy();

    	return redirect()->route('store')->with('message', 'Спасибо! Ваш заказ в обработке');
    }
}
