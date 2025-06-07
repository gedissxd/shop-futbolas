<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use App\Models\Tag;
use App\Models\Variant;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::with('images', 'variants')->get();
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
        'tags' => 'nullable|string',
        'featured' => 'nullable|boolean',
        'variants' => 'required|array',
        'variants.*.name' => 'required|string|max:255',
        'variants.*.stock' => 'required|integer|min:0',
        'image' => 'required|array',
        'image.*' => 'image|max:2000',
    ]);

    // Separate product data from variants data
    $productData = [
        'name' => $validated['name'],
        'price' => $validated['price'],
        'description' => $validated['description'],
        'featured' => $validated['featured'] ?? false, // Ensure featured has a default
    ];

    $product = Product::create($productData);

    // Handle tags
    if (!empty($validated['tags'])) {
        $tags = explode(',', $validated['tags']);
        foreach ($tags as $tag) {
            Tag::create([
                'product_id' => $product->id,
                'name' => trim($tag), // Trim whitespace from tag
            ]);
        }
    }

    // Handle variants
    foreach ($validated['variants'] as $variantData) {
        Variant::create([
            'product_id' => $product->id,
            'name' => $variantData['name'],
            'stock' => $variantData['stock'],
        ]);
    }

    // Handle images
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
        $product = Product::with(['images', 'tags', 'variants'])->findOrFail($id);
        // $tags = Tag::where('product_id', $id)->get(); // Tags are eager loaded with product
        return view('dashboard.edit', compact('product'));
    }

    public function update($id, Request $request)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'tags' => 'nullable|string',
            'featured' => 'nullable|boolean',
            'variants' => 'required|array',
            'variants.*.name' => 'required|string|max:255',
            'variants.*.stock' => 'required|integer|min:0',
            // Image validation can be added here if image updates are allowed
            // 'image' => 'sometimes|array', // Use 'sometimes' if images are optional on update
            // 'image.*' => 'image|max:2000',
        ]);

        $productData = [
            'name' => $validated['name'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'featured' => $validated['featured'] ?? false,
        ];
        
        $product->update($productData);

        // Handle tags
        Tag::where('product_id', $id)->delete(); // Delete existing tags
        if (!empty($validated['tags'])) {
            $tagNames = explode(',', $validated['tags']);
            foreach ($tagNames as $tagName) {
                Tag::create([
                    'product_id' => $product->id,
                    'name' => trim($tagName),
                ]);
            }
        }
        
        // Handle variants
        $product->variants()->delete(); // Delete existing variants
        foreach ($validated['variants'] as $variantData) {
            Variant::create([
                'product_id' => $product->id,
                'name' => $variantData['name'],
                'stock' => $variantData['stock'],
            ]);
        }

        // Handle image updates here if necessary (similar to store method)
        // For now, focusing on variants and core product info.

        $product->load(['images', 'tags', 'variants']); // Reload relations for the view

        return redirect()->route('dashboard.edit', $product->id)->with('message', 'Product updated successfully');
        // Or, if you want to return the view directly:
        // return view('dashboard.edit', compact('product'))->with('message', 'Product updated successfully');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('dashboard')->with('message', 'Product deleted successfully');
    }
}
