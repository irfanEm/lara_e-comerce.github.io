<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class productController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request -> validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'required',
            'stock' => 'required',
        ]);

        $file = $request->file('image');
        $path = "gambar/" . time(). "_" . $request->name. "." . $file->getClientOriginalExtension();

        Storage::disk('local')->put('public/'.$path, file_get_contents($file));

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $path,
            'stock' => $request->stock,
        ]);

        return Redirect::route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('product.detail', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Product $product, Request $request)
    {
        $request -> validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'required',
            'stock' => 'required',
        ]);

        $file = $request->file('image');
        $path = "gambar/" . time(). "_" . $request->name. "." . $file->getClientOriginalExtension();

        Storage::disk('local')->put('public/'.$path, file_get_contents($file));

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $path,
            'stock' => $request->stock,
        ]);

        return Redirect::route('product.detail', $product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return Redirect::route('product.index');
    }
}
