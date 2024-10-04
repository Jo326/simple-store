<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   public function __construct(){
    $this->middleware('auth');
   }

    public function index()
    {
        $products = Product::all();
    return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Product::create($request->all());
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
    return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }


    public function update(Request $request, Product $product)
    {

    $request->validate([
        'nama' => 'required|string|max:255',
        'description' => 'nullable|string',
        'retail_price' => 'required|numeric',
        'wholesale_price' => 'required|numeric',
        'min_wholesale_qty' => 'required|integer',
        'quantity' => 'required|integer',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);


    $product->nama = $request->nama;
    $product->description = $request->description;
    $product->retail_price = $request->retail_price;
    $product->wholesale_price = $request->wholesale_price;
    $product->min_wholesale_qty = $request->min_wholesale_qty;
    $product->quantity = $request->quantity;

    // // Jika ada foto baru, upload dan simpan
    // if ($request->hasFile('photo')) {
    //     // Hapus foto lama jika ada
    //     if ($product->photo) {
    //         Storage::delete($product->photo);
    //     }
    //     // Simpan foto baru
    //     $product->photo = $request->file('photo')->store('products');
    // }

    // Simpan perubahan ke database
    $product->save();

    // Redirect ke halaman daftar produk dengan pesan sukses
    return redirect()->route('products.index')->with('success', 'Product updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
