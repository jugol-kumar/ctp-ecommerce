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
        return inertia("Frontend/Index",[
            'parentCategories' => Category::with(['childrens', 'parent'])->get(),
            'featuredCategories' => Category::where('featured', 1)->get(),
            'topCategories' => Category::where('top', 1)->with('products')->get(),
            'featuredBrands' => Brand::with('products')->get(),
        ]);
    }

    public function singleProduct($slug){
        $product = Product::where('slug', $slug)->with(['category', 'brand', 'active_color', 'category.products'])->first();
        $color = ActiveColor::findOrFail($product->active_color_id);
        return inertia("Frontend/Product/SingleProduct",[
           "product" => $product,
            "color" => $color
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
}
