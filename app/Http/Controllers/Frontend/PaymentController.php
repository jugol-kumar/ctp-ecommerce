<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class PaymentController extends Controller
{
    public function payment(){
        return inertia('Frontend/Customer/Payment',[
            'make_payment' => URL::route('makePayment')
        ]);
    }

    public function makePayment(){
        return inertia('Frontend/Customer/Conformation');
    }
}
