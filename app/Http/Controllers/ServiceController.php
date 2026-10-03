<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Menampilkan daftar layanan (Read)
     */
    public function index(Request $request)
    {
        $query = Service::query();

        // Filter pencarian berdasarkan judul
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where('title', 'like', "%{$search}%");
        }

        $services = $query->orderBy('order')->orderBy('title')
            ->paginate(10)->withQueryString();

        return view('services.index', compact('services'));
    }

    /**
     * Form tambah layanan (Create)
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Simpan layanan baru (Store)
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'icon'        => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'order'       => 'nullable|integer|min:0',
        ]);

        Service::create([
            'title'       => $request->title,
            'icon'        => $request->icon,
            'description' => $request->description,
            'order'       => $request->order ?? 0,
        ]);

        return redirect()->route('services.index')
            ->with('success', 'Layanan berhasil ditambahkan!');
    }

    /**
     * Form edit layanan (Edit)
     */
    public function edit(string $id)
    {
        $service = Service::findOrFail($id);

        return view('services.edit', compact('service'));
    }

    /**
     * Simpan perubahan layanan (Update)
     */
    public function update(Request $request, string $id)
    {
        $service = Service::findOrFail($id);

        $request->validate([
            'title'       => 'required|string|max:255',
            'icon'        => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'order'       => 'nullable|integer|min:0',
        ]);

        $service->update([
            'title'       => $request->title,
            'icon'        => $request->icon,
            'description' => $request->description,
            'order'       => $request->order ?? 0,
        ]);

        return redirect()->route('services.index')
            ->with('success', 'Layanan berhasil diperbarui!');
    }

    /**
     * Hapus layanan (Destroy)
     */
    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);

        $service->delete();

        return redirect()->route('services.index')
            ->with('success', 'Layanan berhasil dihapus!');
    }
}
