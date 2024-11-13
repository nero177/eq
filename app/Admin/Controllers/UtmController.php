<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Widgets\Chart;
use Encore\Admin\Layout\Content;
use App\Services\Admin\OptionsService;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use Encore\Admin\Widgets\Box;
use Illuminate\Support\Facades\Schema;

class UtmController extends Controller
{
    public function __construct(private OptionsService $optionsService)
    {
    }

    public function index(Content $content)
    {
        $utmKeys = [
            'utm_source',
            'utm_medium',
            'utm_compaign',
            'utm_term',
            'utm_content',
        ];

        $utmCollections = [];
        $utmCollectionsBySum = [];

        $fromDate = request()->has('from') ? request()->get('from') : '1970-01-01';
        $toDate = request()->has('to') ? request()->get('to') : date('Y-m-d');

        foreach ($utmKeys as $utmKey) {
            if (Schema::hasColumn('orders', $utmKey)) {
                $utmCollections[$utmKey] = Order::select($utmKey, DB::raw('count(*) as total_orders'))
                    ->whereNotNull($utmKey)
                    ->whereBetween('created_at', [$fromDate, $toDate]) // Apply the date filter
                    ->groupBy($utmKey)
                    ->pluck('total_orders', $utmKey)
                    ->mapWithKeys(function ($value, $key) use ($utmKey) {
                        return [$key === '' ? "Without ${$utmKey}" : $key => $value];
                    });

                $utmCollectionsBySum[$utmKey] = Order::select($utmKey, DB::raw('SUM(amount) as total_amount'))
                    ->whereNotNull($utmKey)
                    ->whereBetween('created_at', [$fromDate, $toDate]) // Apply the date filter
                    ->groupBy($utmKey)
                    ->pluck('total_amount', $utmKey)
                    ->mapWithKeys(function ($value, $key) use ($utmKey) {
                        return [$key === '' ? "Without ${$utmKey}" : $key => $value];
                    });
            }
        }


        // $utmMediumData = Order::select('utm_medium', DB::raw('count(*) as total_orders'))
        //     ->groupBy('utm_medium')
        //     ->pluck('total_orders', 'utm_medium')
        //     ->mapWithKeys(function ($value, $key) {
        //         return [$key === '' ? 'Without utm_medium' : $key => $value];
        //     });

        $content->header('UTM charts');

        return $content->body(view('admin.charts.bar', ['data' => $utmCollections, 'dataBySum' => $utmCollectionsBySum]));
    }
}
