<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Orderable;
use App\Enums\OrderStatus;
use App\Enums\OrderableType;

class DeleteExpiredOrderables extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-expired-orderables';

    /**
     * The console command description.
     *
     * @var string
     */

    protected $description = 'Delete orderables that has period and older than one year';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $orderables = Orderable::where('orderable_type', OrderableType::SUBSCRIPTION->model())->with('orderable')->get();

        foreach($orderables as $orderable){
            $order = $orderable->order()->first();

            $orderCreatedDate = Carbon::parse($order->created_at);
            $subscriptionPeriodDays = $orderable->orderable->period * $orderable->count;

            if ($orderCreatedDate->addDays($subscriptionPeriodDays)->isPast()) {
                $order->status = OrderStatus::EXPIRED->value;
                $order->save();
            }

            // if ($orderCreatedDate->addMinutes(1)->isPast()) {
            //     $order->status = OrderStatus::EXPIRED->value;
            //     $order->save();
            // }
        }

        $this->info('Expired orderables deleted successfully.');
    }
}
