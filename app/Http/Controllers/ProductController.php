<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Http\Middleware\IsAdminMiddleware;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::with('category')->orderby('id', 'desc')->get();
        return view('admin.product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:products,nama',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'categori_id' => 'required|exists:categories,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('products', 'public');
        }

        $product = new Product();
        $product->nama = $request->nama;
        $product->slug = Str::slug($request->nama);
        $product->deskripsi = $request->deskripsi;
        $product->harga = $request->harga;
        $product->stok = $request->stok;
        $product->categori_id = $request->categori_id;
        $product->gambar = $gambarPath;
        $product->save();
        return redirect()->route('admin.product.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:products,nama,' . $product->id,
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'categori_id' => 'required|exists:categories,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $gambarPath = $product->gambar;
        if ($request->hasFile('gambar')) {
            if ($product->gambar) {
                // tambahkan : use Illuminate\Support\Facades\Storage; diatas untuk memanggil class 'Storage' !!
                Storage::disk('public')->delete($product->gambar);
            }
            $gambarPath = $request->file('gambar')->store('products', 'public');
        }

        $product->nama = $request->nama;
        $product->slug = Str::slug($request->nama);
        $product->deskripsi = $request->deskripsi;
        $product->harga = $request->harga;
        $product->stok = $request->stok;
        $product->categori_id = $request->categori_id;
        $product->gambar = $gambarPath;
        $product->save();

        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->gambar) {
            // tambahkan : use Illuminate\Support\Facades\Storage; diatas untuk memanggil class 'Storage' !!
            Storage::disk('public')->delete($product->gambar);
        }
        $product->delete();
        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil dihapus!');        
    }
}
