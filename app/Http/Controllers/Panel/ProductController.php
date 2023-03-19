<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\ActiveColor;
use App\Models\Brand;
use App\Models\Category;

class ProductController extends Controller
{
   public function index(){
       return inertia('Products/Index');
   }

   public function create(){

       $categories = Category::with('childrens')->get();
       $brands = Brand::all();
       $colors = ActiveColor::orderby('name', 'asc')->get();

       return inertia('Products/Create', [
           'categories' => $categories,
           'brands' => $brands,
           'colors' => $colors,
       ]);
   }



}
