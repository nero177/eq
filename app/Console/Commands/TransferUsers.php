<?php

namespace App\Console\Commands;

use App\Enums\OrderableType;
use App\Enums\OrderStatus;
use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Order;

class TransferUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:transfer-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $usersJson = file_get_contents('users.json');
        $ordersJson = file_get_contents('orders.json');
        $usersData = json_decode($usersJson, true);
        $ordersData = json_decode($ordersJson, true);
        $usersToCreate = [];

        foreach ($usersData as $user){
            $usersToCreate[] = [
                'name' => $user['first_name'] || $user['last_name'] ? $user['first_name'] . ' ' . $user['last_name'] : $user['user_login'],
                'email' => $user['user_email'],
                'password' => $user['user_pass'],
            ];
        }

        User::upsert($usersToCreate, ['email']);

        foreach ($ordersData as $orderData) {
            $user = User::firstWhere('email', $orderData['customer_email']);

            if (! $user) {
                continue;
            }

            if ($orderData['status'] == 'failed') {
                $orderStatus = OrderStatus::DECLINED->value;
            }

            if ($orderData['status'] == 'cancelled') {
                $orderStatus = OrderStatus::DECLINED->value;
            }

            if ($orderData['status'] == 'processing') {
                $orderStatus = OrderStatus::PROCESSING->value;
            }

            if ($orderData['status'] == 'completed') {
                $orderStatus = OrderStatus::APPROVED->value;
            }

            $order = Order::create([
                'created_at' => $orderData['order_date'],
                'status' => $orderStatus,
                'order_number' => 'DH' . uniqid(),
                'user_id' => $user->id,
                'amount' => $orderData['order_total']
            ]);

            if ($orderData['Product Item 1 Name'] == 'Стандартна підписка') {
                $order->orderables()->create([
                    'created_at' => $orderData['order_date'],
                    'user_id' => $user->id,
                    'orderable_type' => OrderableType::SUBSCRIPTION->model(),
                    'orderable_id' => 2,
                    'count' => $orderData['Product Item 1 Quantity'],
                    'price' => $orderData['Product Item 1 Total']
                ]);
            }

            if ($orderData['Product Item 1 Name'] == 'Преміум підписка') {
                $order->orderables()->create([
                    'created_at' => $orderData['order_date'],
                    'user_id' => $user->id,
                    'orderable_type' => OrderableType::SUBSCRIPTION->model(),
                    'orderable_id' => 1,
                    'count' => $orderData['Product Item 1 Quantity'],
                    'price' => $orderData['Product Item 1 Total']
                ]);
            }

            if ($orderData['Product Item 2 Name'] == 'Стандартна підписка') {
                $order->orderables()->create([
                    'created_at' => $orderData['order_date'],
                    'user_id' => $user->id,
                    'orderable_type' => OrderableType::SUBSCRIPTION->model(),
                    'orderable_id' => 2,
                    'count' => $orderData['Product Item 2 Quantity'],
                    'price' => $orderData['Product Item 2 Total']
                ]);
            }

            if ($orderData['Product Item 2 Name'] == 'Преміум підписка') {
                $order->orderables()->create([
                    'created_at' => $orderData['order_date'],
                    'user_id' => $user->id,
                    'orderable_type' => OrderableType::SUBSCRIPTION->model(),
                    'orderable_id' => 1,
                    'count' => $orderData['Product Item 2 Quantity'],
                    'price' => $orderData['Product Item 2 Total']
                ]);
            }
        }
    }
}
