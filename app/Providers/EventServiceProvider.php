<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Event::listen('productHasViewed', function ($product) {
            
            $product->counter()->updateOrCreate(
                ['product_id' => $product->id],
                ['view_count' => ++$product->counter->view_count]
            );
        });

        Event::listen('productHasAddedCart', function ($product) {
            
            $product->counter()->updateOrCreate(
                ['product_id' => $product->id],
                ['cart_count' => ++$product->counter->cart_count]
            );
        });
    }
}
