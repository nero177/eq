<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Traits\ProductTrait;
use Jackiedo\Cart\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderService
{
    use ProductTrait;

    public function __construct(private Cart $cart)
    {
    }

    public function createUserOrder()
    {
        $user = auth()->user();
        $preparedProducts = $this->prepareCartProducts($this->cart->getItems(), $user->id);

        if (! $preparedProducts) {
            return false;
        }
        
        $amount = 0;

        // $amount = array_sum(array_column($preparedProducts, 'price'));
        foreach($preparedProducts as $preparedProduct){
            $amount += $preparedProduct['price'] * $preparedProduct['count'];
        };

        $data = [
            'status' => OrderStatus::PROCESSING,
            'order_number' => 'DH' . uniqid(),
            'amount' => $amount,
            'utm_source' => session('utm_source', null),
            'utm_medium' => session('utm_medium', null),
            'utm_campaign' => session('utm_campaign', null),
            'utm_term' => session('utm_term', null),
            'utm_content' => session('utm_content', null),    
        ];

        try {
            DB::beginTransaction();

            $order = $user->orders()->create($data);
            $order->orderables()->createMany($preparedProducts);

            DB::commit();
        } catch (\Exception $e) {
            report($e);
            DB::rollBack();
            return false;
        }

        $this->cart->clearItems();

        return $order;
    }

    public function userLastOrders()
    {
        $user = auth()->user();
        $orders = $user->orders()->with('orderables')->latest()->take(10)->get();
        return $orders;
    }

    public function getOrder($order_number)
    {
        $order = Order::where('order_number', $order_number)->with('orderables.orderable')->first();
        return $order;
    }
}