<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;

class ProductController extends Controller
{
   public function index(){
       return inertia('Products/Index');
   }
}
