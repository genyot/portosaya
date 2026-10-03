<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Menampilkan halaman daftar kategori (Read)
     */
    public function index(Request $request)
    {
        // Query dasar: urutkan terbaru
        $query = Category::latest();

        // Filter pencarian berdasarkan nama atau slug
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        // Paginate + pertahankan query string saat pindah halaman
        $categories = $query->paginate(10)->withQueryString();

        // Tampilkan file view 'categories.index' dan bawa datanya
        return view('categories.index', compact('categories'));
    }

    /**
     * Menampilkan form tambah kategori (Create)
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Menyimpan data kategori baru ke database (Store)
     */
    public function store(Request $request)
    {
    $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        // 2. Buat slug otomatis dari nama kategori (Contoh: "Web Development" menjadi "web-development")
        $slug = \Illuminate\Support\Str::slug($request->name);

        // 3. Simpan ke database menggunakan Model Category
        Category::create([
            'name' => $request->name,
            'slug' => $slug,
        ]);

        // 4. Kembalikan ke halaman index kategori dengan pesan sukses
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit kategori (Edit)
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);

        return view('categories.edit', compact('category'));
    }

    /**
     * Menyimpan perubahan data kategori (Update)
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        // 2. Buat slug baru dari nama yang diubah
        $slug = \Illuminate\Support\Str::slug($request->name);

        // 3. Perbarui data di database
        $category->update([
            'name' => $request->name,
            'slug' => $slug,
        ]);

        // 4. Kembalikan ke halaman index
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * Menghapus data kategori dari database (Destroy)
     */
    public function destroy(Category $category)
    
    {
        $category->delete();

        // Kembalikan ke halaman index dengan pesan sukses
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
}