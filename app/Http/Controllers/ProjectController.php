<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Menampilkan halaman daftar karya (Read)
     */
    public function index(Request $request)
    {
        // Query dasar: muat relasi kategori, urutkan terbaru
        $query = Project::with('category')->latest();

        // Filter pencarian (judul / deskripsi / tools)
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('tools', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan kategori
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Paginate + pertahankan query string saat pindah halaman
        $projects = $query->paginate(10)->withQueryString();

        // Daftar kategori untuk dropdown filter
        $categories = \App\Models\Category::orderBy('name')->get();

        return view('projects.index', compact('projects', 'categories'));
    }

    /**
     * Menampilkan form tambah karya (Create)
     */
    public function create()
    {
        $categories = \App\Models\Category::all();
        
        return view('projects.create', compact('categories'));
    }

    /**
     * Menyimpan data karya baru ke database (Store)
     */
    public function store(Request $request)
    {
       $request->validate([
            'title'          => 'required|string|max:255',
            'category_id'    => 'required|exists:categories,id',
            'year'           => 'required|string|max:4',
            'description'    => 'required|string',
            'tools'          => 'nullable|string',
            'project_link'   => 'nullable|url',
            'instagram_link' => 'nullable|url',
            'image'          => 'required|image|mimes:jpeg,png,jpg|max:2048', 
            'status'         => 'required|in:Published,Draft',
        ]);
        // 2. Proses Upload Gambar
        // Simpan file gambar ke dalam folder 'storage/app/public/projects'
        $imagePath = $request->file('image')->store('projects', 'public');

        // 3. Buat slug yang unik (Misal: eksistensi-typography-169876543)
        $slug = \Illuminate\Support\Str::slug($request->title) . '-' . time();

        // 4. Simpan semua data ke database
        Project::create([
            'title'          => $request->title,
            'slug'           => $slug,
            'category_id'    => $request->category_id,
            'year'           => $request->year,
            'description'    => $request->description,
            'tools'          => $request->tools,
            'project_link'   => $request->project_link,
            'instagram_link' => $request->instagram_link,
            'image'          => $imagePath,
            'status'         => $request->status,
        ]);

        // 5. Kembali ke halaman daftar karya dengan pesan sukses
        return redirect()->route('projects.index')->with('success', 'Karya berhasil ditambahkan!');
    
    }
    

    /**
     * Menampilkan detail satu karya (Show)
     */
    public function show(string $id)
    {
        // Ambil karya beserta kategorinya, gagal -> 404
        $project = Project::with('category')->findOrFail($id);

        return view('projects.show', compact('project'));
    }

    /**
     * Menampilkan form edit karya (Edit)
     */
    public function edit(string $id)
    {
        // Cari karya berdasarkan id, gagal -> 404
        $project = Project::findOrFail($id);

        // Butuh daftar kategori untuk mengisi dropdown di form
        $categories = \App\Models\Category::all();

        return view('projects.edit', compact('project', 'categories'));
    }

    /**
     * Menyimpan perubahan data karya (Update)
     */
    public function update(Request $request, string $id)
    {
        // 1. Cari karya yang akan diubah
        $project = Project::findOrFail($id);

        // 2. Validasi input (image dibuat nullable karena boleh tidak ganti gambar)
        $request->validate([
            'title'          => 'required|string|max:255',
            'category_id'    => 'required|exists:categories,id',
            'year'           => 'required|string|max:4',
            'description'    => 'required|string',
            'tools'          => 'nullable|string',
            'project_link'   => 'nullable|url',
            'instagram_link' => 'nullable|url',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status'         => 'required|in:Published,Draft',
        ]);

        // 3. Siapkan data yang akan diperbarui
        $data = [
            'title'          => $request->title,
            'category_id'    => $request->category_id,
            'year'           => $request->year,
            'description'    => $request->description,
            'tools'          => $request->tools,
            'project_link'   => $request->project_link,
            'instagram_link' => $request->instagram_link,
            'status'         => $request->status,
        ];

        // 4. Kalau user upload gambar baru, ganti gambar lama
        if ($request->hasFile('image')) {

            // Hapus file gambar lama dari storage supaya tidak menumpuk
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }

            $data['image'] = $request->file('image')->store('projects', 'public');
        }

        // 5. Perbarui slug kalau judul berubah (biar tetap relevan)
        if ($project->title !== $request->title) {
            $data['slug'] = Str::slug($request->title) . '-' . time();
        }

        // 6. Simpan perubahan
        $project->update($data);

        return redirect()->route('projects.index')->with('success', 'Karya berhasil diperbarui!');
    }

    /**
     * Menghapus data karya dari database (Destroy)
     */
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);

        // Hapus file gambar dari storage sebelum baris database dihapus
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }

        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Karya berhasil dihapus!');
    }
}