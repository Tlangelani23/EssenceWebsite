<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function home()
    {
        $products = Product::take(3)->get();

        return view('home', compact('products'));
    }

    public function catalog()
    {
        $products = Product::all();

        return view('catalog', compact('products'));
    }
}