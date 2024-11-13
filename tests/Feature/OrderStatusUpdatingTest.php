<?php

namespace Tests\Feature;

use App\Enums\OrderStatus;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Order;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OrderStatusUpdatingTest extends TestCase
{
    use DatabaseTransactions;
    
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $order = Order::first();
        $order->status = OrderStatus::APPROVED->value;
        $order->save();

        $response->assertStatus(200);
    }
}
