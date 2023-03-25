<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;

class PaymentController extends Controller
{
    public function payment(){
        return inertia('Frontend/Customer/Payment',[
            'make_payment' => URL::route('makePayment'),
            'info' => [
                "status"=>200,
                "message" => 'Checkout Successful, Make Payment Now...'
            ]
        ]);
    }

    public function makePayment(){
        return inertia('Frontend/Customer/Conformation');
    }
}
