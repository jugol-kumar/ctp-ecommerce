<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Properties;
use App\Models\ActiveColor;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;

class ProductController extends Controller
{
   public function index(){
       return inertia('Products/Index',[
           'products' => Product::with(['category', 'brand', 'user'])->paginate(12)
       ]);
   }

   public function create(){

       $categories = Category::with('childrens')->get();
       $brands = Brand::all();
       $colors = ActiveColor::orderby('name', 'asc')->get();

       return inertia('Products/Create', [
           'categories' => $categories,
           'brands' => $brands,
           'colors' => $colors,
           'save_url' => URL::route('admin.product.store')
       ]);
   }

   public function store(){
       Request::validate([
           'productTitle' => 'required',
           'categoryId' => 'required',
           'brandId' => 'required',
           'productPrice' => 'required',
           'unit' => 'required',
           'qty' => 'required',
           'description' => 'nullable|max:400|min:100'
       ]);

       if (Request::input('discountAmount') != null){
           Request::validate([
               'discountType' => 'required'
           ]);
       }

       if (Request::input('shippingType') === 'p'){
           Request::validate([
               'inSideDhaka' => 'required',
               'outSideDhaka' => 'required',
           ]);
       }

       if (Request::hasFile('thumbnail')){
           $icon = Request::file('thumbnail')->store('uploads/all', 'public');
           fileResize(Request::file('thumbnail'), $icon, Properties::$productImageWeight, Properties::$productImageHeight);
           $data['thumbnail'] = $icon;
       }

       $images = [];
       if (Request::file('images')){
           foreach (Request::file('images') as $img){
               $path = $img->store('uploads/all', 'public');
               fileResize($img, $path, 200, 300);
               $images[] = $path;
           }
       }


       $data['sku'] = Request::input('productId');
       $data['title'] = Request::input('productTitle');
       $data['user_id'] = Auth::id();
       $data['category_id'] = Request::input('categoryId') ? intval(Request::input('categoryId')["value"]["id"]) : null;
       $data['brand_id'] = Request::input('brandId') ? intval(Request::input('brandId')["id"]) : null;
       $data['active_color_id'] = Request::input('colorId') ? intval(Request::input('colorId')["id"]) : null;

       $data['price'] = intval(Request::input('productPrice'));
       $data['discount'] = intval(Request::input('discountAmount'));
       $data['discount_type'] = Request::input('discountType');
       $data['unit'] = Request::input('unit');
       $data['qty'] = intval(Request::input('qty'));
       $data['low_stoke_qty'] = intval(Request::input('low_stoke_qty'));
       $data['images'] = json_encode($images);
       $data['sizes'] = json_encode(Request::input('sizes'));
       $data['description'] = Request::input('description');
       $data['specification'] = Request::input('specification');
       $data['shipping_type'] = Request::input('shippingType');
       $data['inside_in_dhaka'] = intval(Request::input('inSideDhaka'));
       $data['outside_in_dhaka'] = intval(Request::input('outSideDhaka'));
       $data['cod'] = filled(Request::input('cod'));
       $data['tax'] = Request::input('tax');
       $data['tax_type'] = Request::input('taxType');
       $data['vat'] = Request::input('vat');
       $data['vat_type'] = Request::input('vatType');

       Product::create($data);
       return back();

   }


}
