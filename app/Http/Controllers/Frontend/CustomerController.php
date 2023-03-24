<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use function Symfony\Component\Routing\Matcher\Dumper\indent;

class CustomerController extends Controller
{
    public function login(){
        return inertia("Frontend/Auth/Login", [
            'login_url' => URL::route('customer.checkLogin'),
            'reg_url' => URL::route('customer.checkRegistration')
        ]);
    }

    public function checkLogin(){
        $credentials = Request::validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            Request::session()->regenerate();
            return Redirect::route('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);

    }


    public function dashboard(){
        return inertia('Frontend/Customer/Dashboard');
    }



    public function checkRegistration(){
        return Request::all();
    }
}
