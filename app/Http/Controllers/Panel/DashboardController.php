<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Properties;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Inertia\ResponseFactory;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
//        if (is_string(Request::input('data')) && Request::input('data') === Properties::$true){
//            return jsonResponse('', '', '', "This is my message");
//        }else{
//            return jsonResponse('error', '404', '', "Wrong permitted passed");
//        }

        return inertia('Dashboard');
    }
}
