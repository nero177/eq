<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Models\Order;

class OrderController extends Controller
{
    public function __construct(private OrderService $orderService)
    {
        $this->middleware('auth:web');
    }

    public function lastOrders(Request $request)
    {
        $orders = $this->orderService->userLastOrders();

        return view('order.index', compact(['orders']));
    }

    public function show(Request $request, $order_number)
    {
        $order = $this->orderService->getOrder($order_number);
        return view('order.show', compact(['order']));
    }
}
