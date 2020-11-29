<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\Status;
use App\Mail\PaymentMethod;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class OrdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('id', 'desc')->get();
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('admin.orders.view', [
            'order' => $order,
            'statuses' => Status::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        if($request->status_id) {
            $order->status_id = $request->status_id;
            $order->save();
        } elseif ($request->shipping_no) {
            $order->shipping_no = $request->shipping_no;
            $order->save();
        }

        return redirect()->route('admin.order.show', compact('order'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function paymethod(Order $order)
    {
        $mailstore = env('MAIL_STORE');
        $mailcopy = env('MAIL_STORE_COPY');

        Mail::to($mailstore)
            ->cc($mailcopy)
            ->send(new PaymentMethod($order));

        return redirect()->route('admin.order.show', compact('order'))->with('message', 'Сообщение отправленно');;
    }
}
