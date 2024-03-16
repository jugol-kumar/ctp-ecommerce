<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Inertia\Inertia;
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
            return Redirect::intended('/dashboard');// route('dashboard');
        }

        return back()->withErrors([
            'message' => 'The provided credentials do not match our records.',
        ]);
    }


    public function dashboard(){
        return inertia('Frontend/Customer/Dashboard',[
            'orders' => Auth::user()->load('orders'),
        ]);
    }



    public function checkRegistration(){
        return Request::all();
    }

    public function updateProfile(){
        $user = User::findOrFail(Auth::id());
        $user->name = Request::input('name') ?? $user->name;
        $user->email = Request::input('email') ?? $user->email;
        $user->phone = Request::input('phone') ?? $user->phone;
        $user->update();

        return back();
    }

    public function updatePassword(){
        $user = Auth::user();
        $hashedPassword = $user->password;

        if ( Hash::check(Request::input('current') , $hashedPassword)){
            if (!Hash::check(Request::input("new"), $hashedPassword)){
                $user->update([
                    'password' => Hash::make(Request::input("new"))
                ]);
                Auth::logout();
                return redirect()->route('customer.login');
            }else{
                return Inertia::render('Frontend/Customer/Dashboard', [
                    'errors' => 'New Password Can Not Be Same As Same Password',
                    'orders' => Auth::user()->load('orders'),
                ])->with('error', 'New Password Can Not Be Same As Same Password');
            }
        }else{

            return Inertia::render('Frontend/Customer/Dashboard', [
                'errors' => 'Current Password Not Match',
                'orders' => Auth::user()->load('orders'),
            ])->with('error', 'New Password Can Not Be Same As Same Password');
        }

        return back();


    }

}
