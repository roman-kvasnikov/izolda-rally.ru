<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // dump(session()->all());

        $products = session()->has('addedProducts') ? session('addedProducts') : Product::where('is_published', 1)->get();

        return view('products', compact('products'));
    }

    public function save_cart(Request $addedProducts)
    {
        session(['addedProducts' => $addedProducts]);

        return session('addedProducts');
    }
}
