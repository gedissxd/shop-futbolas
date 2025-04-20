<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('dashboard.index', compact('products'));
    }

    public function create()
{
    return view('dashboard.create');
}

public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'description' => 'required|string',
        'variant' => 'required|string',
        'stock' => 'required|integer|min:0',
    ]);

    $request->validate([
        'image' => 'required|array',
        'image.*' => 'image|max:2000',
    ]);

    $product = Product::create($validated);

    if ($request->hasFile('image')) {
        foreach ($request->file('image') as $imageFile) {
            try {

                $path = $imageFile->storePublicly('images', ['disk' => 's3']);
                
                Image::create([
                    'product_id' => $product->id,
                    'image' => $path,
                ]);
            } catch (\Exception $e) {
                \Log::error('S3 upload error: ' . $e->getMessage());
            
            }
        }
    }
    
    return redirect()->route('dashboard')->with('message', 'Product created successfully');
}

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('dashboard.edit', compact('product'));
    }

    public function update($id, Request $request) 
    {
        $product = Product::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'variant' => 'required|string',
            'stock' => 'required|integer|min:0',
        ]);
        
        $product->update($validated);
        
        return view('dashboard.edit', compact('product'));
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('dashboard')->with('message', 'Product deleted successfully');
    }
}
