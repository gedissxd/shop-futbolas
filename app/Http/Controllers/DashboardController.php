<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use App\Models\Tag;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::with('images')->get();
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
        'tags' => 'nullable|string',
        'featured' => 'nullable|boolean',
    ]);

    $request->validate([
        'image' => 'required|array',
        'image.*' => 'image|max:2000',
    ]);

    $product = Product::create($validated);

    $tags = explode(',', $request->input('tags'));
    foreach ($tags as $tag) {
        Tag::create([
            'product_id' => $product->id,
            'name' => $tag,
        ]);
    }

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $imageFile) {
                $path = $imageFile->store('images', 's3');
                Image::create([
                    'product_id' => $product->id,
                    'image' => $path,
                ]);
        }
    }
    return redirect()->route('dashboard')->with('message', 'Product created successfully');
}

    public function edit($id)
    {
        $product = Product::with(['images', 'tags'])->findOrFail($id);
        $tags = Tag::where('product_id', $id)->get();
        return view('dashboard.edit', compact('product', 'tags'));
    }

    public function update($id, Request $request)
    {
        $product = Product::findOrFail($id);
        $tags = Tag::where('product_id', $id)->get();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'variant' => 'required|string',
            'stock' => 'required|integer|min:0',
        ]);

        $validatedTags = $request->validate([
            'tags' => 'required|string',
        ]);

        $validated['featured'] = $request->boolean('featured');
        
        // Delete existing tags
        Tag::where('product_id', $id)->delete();
        
        // Create new tags
        $tags = explode(',', $validatedTags['tags']);
        foreach ($tags as $tag) {
            Tag::create([
                'product_id' => $id,
                'name' => trim($tag),
            ]);
        }
        
        $product->update($validated);

        return view('dashboard.edit', compact('product', 'tags'));
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('dashboard')->with('message', 'Product deleted successfully');
    }
}
