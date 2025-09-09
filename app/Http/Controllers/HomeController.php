<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $saleProducts = Product::where('is_sale', true)->get();
        return view('welcome', compact('saleProducts'));
    }
}


