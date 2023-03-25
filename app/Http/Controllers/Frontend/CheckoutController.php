<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Checkout;
use App\Models\CustomerCart;
use App\Models\District;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class CheckoutController extends Controller
{
    public function checkout(){
        return inertia('Frontend/Customer/Checkout', [
            'main_url' => URL::route('addCheckout'),
            'cities' => District::all(),
            'shippingType' => get_setting('shippingType'),
            'shippingPrice' => ['inDhaka' => get_setting('inSizeDhaka'), 'outDhaka' => get_setting('outSizeDhaka')],
            "checkOutData" => Session::get('checkoutData'),
        ]);
    }


    public function addCheckout(){
        $data = Request::all();
        $cart = CustomerCart::create([
            'customer_id' => Auth::id(),
            'cartItems' => json_encode(Request::input('cartItems'))
        ]);

        $address = Address::create([
            "user_id" => Auth::id(),
            "address" => $data["formData"]["address"],
            "phone" => $data["formData"]["phone"],
            "city" => $data["formData"]["city"],
        ]);

        $checkout = Checkout::create([
            "customer_id" => Auth::id(),
            "customer_cart_id" => $cart->id,
            "address_id" => $address->id,
            "delivery_charge" =>  $data["deliveryCharge"],
            "cart_total_price" =>$data['cartTotalPrice'],
            "checkout_date" => now()->format('d-m-Y'),
        ]);
        $checkout['totalItems'] = Request::input('totalItems');

        Session::put('checkoutData', [
            "data" => $checkout,
        ]);

        return inertia('Frontend/Customer/Checkout', [
            "checkOutData" => Session::get('checkoutData'),
            'info' => [
                "status"=>200,
                "message" => 'Checkout Successful, Make Payment Now...'
            ]]);

//        return redirect()->route('payment')->with([
//            'checkoutDetails' => $checkout
//        ]);
    }

}
