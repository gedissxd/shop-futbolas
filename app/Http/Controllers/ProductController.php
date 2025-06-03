<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        return view('products.index');
    }

    public function show($name)
    {
        $product = Product::where('name', $name)->firstOrFail();
        return view('products.show', compact('product'));
    }

    public function showFeatured()
    {
        $products = Product::where('featured', true)->take(4)->get();
        return view('home', compact('products'));
    }


}
