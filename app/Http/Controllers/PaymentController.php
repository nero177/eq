<?php

namespace App\Http\Controllers;

use App\Services\Payment\WayForPay;
use Illuminate\Http\Request;
use Jackiedo\Cart\Cart;
use App\Http\Requests\PurchaseRequest;
use App\Contracts\PaymentProviderInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function __construct(private Cart $cart, private PaymentProviderInterface $paymentService)
    {
    }

    public function checkout()
    {
        $items = $this->cart->getItems();

        $productIds = collect($items)->map(function ($item){
            return $item->getId();
        })->toArray();

        $productIds = join(', ', array_values($productIds));

        if (! count($items)) {
            return redirect()->route('cart.view');
        }

        return view('order.checkout', compact('items', 'productIds'));
    }

    public function purchase(PurchaseRequest $request)
    {
        $request->validated();

        $paymentLink = $this->paymentService->purchase($request->name, $request->surname, $request->email, $request->phone);

        return redirect()->away($paymentLink);
    }

    public function updateOrderStatus(Request $request)
    {
        $json = file_get_contents('php://input');
        $obj = json_decode($json, TRUE);

        $response = $this->paymentService->orderConfirmation(
            $obj['orderReference'], 
            $obj['processingDate'], 
            $obj['merchantSignature'], 
            $obj['reasonCode']
        );
        
        return response()->json($response);
        // dd($request->all());
    }
}
