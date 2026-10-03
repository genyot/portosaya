<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    /**
     * Menampilkan daftar pengalaman (Read)
     */
    public function index(Request $request)
    {
        $query = Experience::query();

        // Filter pencarian berdasarkan posisi / perusahaan
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('position', 'like', "%{$search}%")
                  ->orWhere('company', 'like', "%{$search}%");
            });
        }

        $experiences = $query->orderBy('order')
            ->orderByDesc('start_year')
            ->paginate(10)->withQueryString();

        return view('experiences.index', compact('experiences'));
    }

    /**
     * Form tambah pengalaman (Create)
     */
    public function create()
    {
        return view('experiences.create');
    }

    /**
     * Simpan pengalaman baru (Store)
     */
    public function store(Request $request)
    {
        $request->validate([
            'position'    => 'required|string|max:255',
            'company'     => 'required|string|max:255',
            'start_year'  => 'required|string|max:4',
            'end_year'    => 'nullable|string|max:4',
            'description' => 'nullable|string',
            'order'       => 'nullable|integer|min:0',
        ]);

        Experience::create([
            'position'    => $request->position,
            'company'     => $request->company,
            'start_year'  => $request->start_year,
            'end_year'    => $request->end_year,
            'description' => $request->description,
            'order'       => $request->order ?? 0,
        ]);

        return redirect()->route('experiences.index')
            ->with('success', 'Pengalaman berhasil ditambahkan!');
    }

    /**
     * Form edit pengalaman (Edit)
     */
    public function edit(string $id)
    {
        $experience = Experience::findOrFail($id);

        return view('experiences.edit', compact('experience'));
    }

    /**
     * Simpan perubahan pengalaman (Update)
     */
    public function update(Request $request, string $id)
    {
        $experience = Experience::findOrFail($id);

        $request->validate([
            'position'    => 'required|string|max:255',
            'company'     => 'required|string|max:255',
            'start_year'  => 'required|string|max:4',
            'end_year'    => 'nullable|string|max:4',
            'description' => 'nullable|string',
            'order'       => 'nullable|integer|min:0',
        ]);

        $experience->update([
            'position'    => $request->position,
            'company'     => $request->company,
            'start_year'  => $request->start_year,
            'end_year'    => $request->end_year,
            'description' => $request->description,
            'order'       => $request->order ?? 0,
        ]);

        return redirect()->route('experiences.index')
            ->with('success', 'Pengalaman berhasil diperbarui!');
    }

    /**
     * Hapus pengalaman (Destroy)
     */
    public function destroy(string $id)
    {
        $experience = Experience::findOrFail($id);

        $experience->delete();

        return redirect()->route('experiences.index')
            ->with('success', 'Pengalaman berhasil dihapus!');
    }
}
