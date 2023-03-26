<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;

class OrderController extends Controller
{
    public function index(){
        return inertia('Order/Orders',[
            'orders' => Order::query()
                ->with(['orderDetails', 'customer'])
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhereHas('childrens', function ($developer) use($search){
                            $developer->where('title', 'like', "%{$search}%");
                        });
                    ;
                })
                ->latest()
                ->paginate(Request::input('perPage') ?? 10)
                ->withQueryString()
                ->through(fn($order) => [
                    'item' => $order
                ]),
            'filters' => Request::only(['search','perPage', 'dateRange']),

        ]);
    }
}
