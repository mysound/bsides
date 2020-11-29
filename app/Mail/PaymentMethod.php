<?php

namespace App\Mail;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentMethod extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $shippingPrice = (($this->order->products->count() - 1) * 50) + 200;
        return $this->markdown('admin.emails.payment.method')
                    ->with([
                        'shippingPrice' => $shippingPrice
                    ]);
    }
}
