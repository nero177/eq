<?php

namespace App\Providers;

use App\Contracts\PaymentProviderInterface;
use App\Services\OrderService;
use Illuminate\Support\ServiceProvider;
use App\Services\Payment\WayForPay;
use Jackiedo\Cart\Cart;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */

    public function register(): void
    {
        $this->app->singleton(PaymentProviderInterface::class, function ($app){
            $cart = new Cart();
            $orderService = new OrderService($cart);
            return new WayForPay($orderService);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
