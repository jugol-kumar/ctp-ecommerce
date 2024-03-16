<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Checkout;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class PaymentController extends Controller
{
    public function payment(){
        return inertia('Frontend/Customer/Payment',[
            'make_payment' => URL::route('makePayment'),
            'info' => [
                "status"=>200,
                "message" => 'Checkout Successful, Make Payment Now...'
            ],
            'checkoutData' => Session::get('checkoutData')
        ]);
    }

    public function makePayment(){
        $checkout =  Session::get('checkoutData');

        $checkoutDetails = Checkout::with(['customerCart', 'address'])->where('id', $checkout["data"]['id'])->first();

        $cartData = json_decode($checkoutDetails->customerCart->cartItems);

        $order = Order::create([
            'user_id' => Auth::id(),
            'address_id' => $checkoutDetails->address_id,
            'delivery_charge' => $checkoutDetails->delivery_charge,
            'cart_total_price' => $checkoutDetails->cart_total_price,
            'check_out_date' => $checkoutDetails->checkout_date,
            'order_date' => now()->format('d-m-y'),
            'payment_method' => Request::input('paymentMethod'),
            'order_status' => 'pending',
            'payment_status' => 'pending',
        ]);
        foreach ($cartData as $item){
            OrderDetails::create([
                'order_id' => $order->id,
                'product_id' => $item->id,
                'quantity' => $item->quantity,
                'buy_size' => $item->size
            ]);
        }
        Session::forget('checkoutData');
        $checkoutDetails->delete();

        return inertia('Frontend/Customer/Conformation',[
            "order" => $order->load('orderDetails')
        ]);
    }

    public function orderComplete(){
        return inertia('Frontend/Customer/Conformation');
    }

}
