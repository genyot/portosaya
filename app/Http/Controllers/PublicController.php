<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Experience;
use App\Models\Message;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Halaman publik utama (portfolio).
     */
    public function home()
    {
        // Semua data portfolio dari backend
        $projects = Project::with('category')
            ->where('status', 'Published')
            ->latest()
            ->take(6)
            ->get();

        $services    = Service::orderBy('order')->orderBy('title')->get();
        $skills      = Skill::orderBy('order')->orderBy('name')->get();
        $experiences = Experience::orderBy('order')->orderByDesc('start_year')->get();
        $testimonials = Testimonial::orderBy('order')->latest()->get();

        // Pemilik portfolio (user admin) — untuk hero & kontak
        $owner = User::first();

        return view('public.home', compact(
            'projects',
            'services',
            'skills',
            'experiences',
            'testimonials',
            'owner',
        ));
    }

    /**
     * Terima pesan dari form kontak.
     */
    public function contact(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        Message::create($validated);

        return redirect()
            ->route('home')
            ->with('contact_success', 'Pesan kamu berhasil terkirim. Terima kasih!');
    }

    /**
     * Halaman detail karya (publik).
     */
    public function projectShow(string $id)
    {
        $project = Project::with('category')->findOrFail($id);

        // Karya lain (selain yang ini), untuk rekomendasi di bawah
        $otherProjects = Project::with('category')
            ->where('status', 'Published')
            ->where('id', '!=', $project->id)
            ->latest()
            ->take(3)
            ->get();

        $owner = User::first();

        return view('public.project', compact('project', 'otherProjects', 'owner'));
    }
}
