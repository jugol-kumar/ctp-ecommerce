<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ActiveColor;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;

class ProductController extends Controller
{
    public function products(){
/*        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        if ($request->has('brand')) {
            $query->where('brand', $request->brand);
        }

        if ($request->has('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }

        if ($request->has('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        if ($request->has('sort_by')) {
            $sort_by = $request->sort_by;

            if ($sort_by === 'price_low_high') {
                $query->orderBy('price', 'asc');
            } else if ($sort_by === 'price_high_low') {
                $query->orderBy('price', 'desc');
            } else if ($sort_by === 'newest_first') {
                $query->orderBy('created_at', 'desc');
            } else if ($sort_by === 'oldest_first') {
                $query->orderBy('created_at', 'asc');
            }
        }*/
        return inertia('Frontend/Product/Products',[
            'products' => Product::query()
                ->with(['category', 'brand', 'user'])
                ->when(Request::input('category'), function ($query, $search){
                    $query->whereHas('category', function ($query)use($search){
                        $query->where('slug', $search);
                    });
                })
                ->when(Request::input('brand'), function ($query, $search){
                    $query->whereHas('brand', function ($query)use($search){
                        $query->where('slug', $search);
                    });
                })
                ->latest()
                ->paginate(Request::input('perPage') ?? 12)
                ->withQueryString()
                ->through(fn($product) => [
                    'product' => $product
                ]),
            'filters' => Request::only(['search','perPage', 'dateRange']),

            'categories' => Category::with('childrens')->get(),
            'brands' => Brand::all(),

            'main_url' => URL::route('admin.brand.index')
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

}

