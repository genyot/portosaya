<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    /**
     * Daftar testimoni (admin)
     */
    public function index(Request $request)
    {
        $query = Testimonial::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('role', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        $testimonials = $query->orderBy('order')->latest()
            ->paginate(10)->withQueryString();

        return view('testimonials.index', compact('testimonials'));
    }

    /**
     * Form tambah testimoni
     */
    public function create()
    {
        return view('testimonials.create');
    }

    /**
     * Simpan testimoni baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'role'    => 'nullable|string|max:255',
            'message' => 'required|string|max:2000',
            'photo'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'rating'  => 'required|integer|min:1|max:5',
            'order'   => 'nullable|integer|min:0',
        ]);

        $data = [
            'name'    => $request->name,
            'role'    => $request->role,
            'message' => $request->message,
            'rating'  => $request->rating,
            'order'   => $request->order ?? 0,
        ];

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('testimonials', 'public');
        }

        Testimonial::create($data);

        return redirect()->route('testimonials.index')
            ->with('success', 'Testimoni berhasil ditambahkan!');
    }

    /**
     * Form edit testimoni
     */
    public function edit(string $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        return view('testimonials.edit', compact('testimonial'));
    }

    /**
     * Simpan perubahan testimoni
     */
    public function update(Request $request, string $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        $request->validate([
            'name'    => 'required|string|max:255',
            'role'    => 'nullable|string|max:255',
            'message' => 'required|string|max:2000',
            'photo'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'rating'  => 'required|integer|min:1|max:5',
            'order'   => 'nullable|integer|min:0',
        ]);

        $data = [
            'name'    => $request->name,
            'role'    => $request->role,
            'message' => $request->message,
            'rating'  => $request->rating,
            'order'   => $request->order ?? 0,
        ];

        if ($request->hasFile('photo')) {
            if ($testimonial->photo) {
                Storage::disk('public')->delete($testimonial->photo);
            }

            $data['photo'] = $request->file('photo')->store('testimonials', 'public');
        }

        $testimonial->update($data);

        return redirect()->route('testimonials.index')
            ->with('success', 'Testimoni berhasil diperbarui!');
    }

    /**
     * Hapus testimoni
     */
    public function destroy(string $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        if ($testimonial->photo) {
            Storage::disk('public')->delete($testimonial->photo);
        }

        $testimonial->delete();

        return redirect()->route('testimonials.index')
            ->with('success', 'Testimoni berhasil dihapus!');
    }
}
