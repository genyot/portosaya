<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Menampilkan daftar skill (Read)
     */
    public function index(Request $request)
    {
        $query = Skill::query();

        // Filter pencarian berdasarkan nama / kategori
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        // Urutkan: order lalu nama
        $skills = $query->orderBy('order')->orderBy('name')
            ->paginate(10)->withQueryString();

        return view('skills.index', compact('skills'));
    }

    /**
     * Form tambah skill (Create)
     */
    public function create()
    {
        return view('skills.create');
    }

    /**
     * Simpan skill baru (Store)
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'level'    => 'required|integer|min:0|max:100',
            'category' => 'nullable|string|max:255',
            'order'    => 'nullable|integer|min:0',
        ]);

        Skill::create([
            'name'     => $request->name,
            'level'    => $request->level,
            'category' => $request->category,
            'order'    => $request->order ?? 0,
        ]);

        return redirect()->route('skills.index')
            ->with('success', 'Skill berhasil ditambahkan!');
    }

    /**
     * Form edit skill (Edit)
     */
    public function edit(string $id)
    {
        $skill = Skill::findOrFail($id);

        return view('skills.edit', compact('skill'));
    }

    /**
     * Simpan perubahan skill (Update)
     */
    public function update(Request $request, string $id)
    {
        $skill = Skill::findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'level'    => 'required|integer|min:0|max:100',
            'category' => 'nullable|string|max:255',
            'order'    => 'nullable|integer|min:0',
        ]);

        $skill->update([
            'name'     => $request->name,
            'level'    => $request->level,
            'category' => $request->category,
            'order'    => $request->order ?? 0,
        ]);

        return redirect()->route('skills.index')
            ->with('success', 'Skill berhasil diperbarui!');
    }

    /**
     * Hapus skill (Destroy)
     */
    public function destroy(string $id)
    {
        $skill = Skill::findOrFail($id);

        $skill->delete();

        return redirect()->route('skills.index')
            ->with('success', 'Skill berhasil dihapus!');
    }
}
