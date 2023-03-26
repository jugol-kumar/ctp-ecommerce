<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Properties;
use App\Models\ActiveColor;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $category = json_decode(get_setting('categoryId'));

        $category = Category::with('products')->whereIn('id', $category)->get();


        return inertia("Frontend/Index",[
            'featuredCategories' => Category::where('featured', 1)->get(),
            'featuredBrands' => Brand::with('products')->get(),
            'homeCategory' => $category
        ]);
    }



    public function fetchTopCategories(){
        return Category::with('childrens')->where('top', 1)->latest()->take(10)->get();
    }
    public function fetchFeaturedCategories(){
        return Category::with('childrens')->whereNull('parent_id')->latest()->take(10)->get();

    }


    public function cartDetails(){
        return inertia('Frontend/Customer/CartDetails');
    }




//    public function index(){
//        ->when(Request::input('search'), function ($query, $search) {
//            $query->where('u_id', 'like', "%{$search}%")
//                ->orWhereHas('client', function ($client) use($search){
//                    $client
//                        ->where('name',    'like', "%{$search}%")
//                        ->orWhere('phone', 'like', "%{$search}%")
//                        ->orWhere('email', 'like', "%{$search}%")
//                    ;
//                })
//                ->orWhereHas('domains', function($hosting) use($search){
//                    $hosting->where('name', 'like', "%{$search}%");
//                })
//                ->orWhereHas('hostings', function($hosting) use($search){
//                    $hosting->where('name', 'like', "%{$search}%");
//                })
//                ->orWhereHas('works', function($hosting) use($search){
//                    $hosting->where('name', 'like', "%{$search}%");
//                })
//                ->orWhereHas('packages', function($hosting) use($search){
//                    $hosting->where('name', 'like', "%{$search}%");
//                })
//                ->orWhereHas('quotationItems', function($hosting) use($search){
//                    $hosting->where('item_name', 'like', "%{$search}%");
//                });
//        })
//            ->when(Request::input('byStatus'), function ($query, $search){
//                $query->where('status', $search);
//            })
//    }


    public function trams(){
            return inertia('Frontend/Trams');
    }

    public function policy(){
            return inertia('Frontend/Policy');
    }


}
