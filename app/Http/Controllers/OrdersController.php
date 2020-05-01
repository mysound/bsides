<?php

namespace App\Http\Controllers;

use App\Mail\Neworder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrdersController extends Controller
{
    public function store()
    {
    	request()->validate([
    		'email' => 'required|email',
            'last_name' => 'required',
            'first_name' => 'required',
            'phone' => 'required',
            'zip_code' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
    	]);

    	Mail::to(request('email'))
            ->send(new Neworder());

    	return view('store.cart');
    }
}
