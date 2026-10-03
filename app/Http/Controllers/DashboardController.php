<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard admin dengan data statistik nyata.
     */
    public function index()
    {
        // ===== Statistik utama =====
        $totalProjects   = Project::count();
        $totalCategories = Category::count();
        $totalPublished  = Project::where('status', 'Published')->count();
        $totalDraft      = Project::where('status', 'Draft')->count();

        // ===== Karya terbaru (5 terakhir) =====
        $latestProjects = Project::with('category')
            ->latest()
            ->take(5)
            ->get();

        // ===== Ringkasan: hitung persentase tiap bar =====
        // Basis = angka terbesar, biar bar-nya proporsional.
        $maxValue = max($totalProjects, $totalCategories, 1);

        $summary = [
            'projects' => [
                'label'   => 'Karya',
                'value'   => $totalProjects,
                'percent' => round(($totalProjects / $maxValue) * 100),
                'color'   => 'purple',
            ],
            'categories' => [
                'label'   => 'Kategori',
                'value'   => $totalCategories,
                'percent' => round(($totalCategories / $maxValue) * 100),
                'color'   => 'blue',
            ],
            'published' => [
                'label'   => 'Published',
                'value'   => $totalPublished,
                'percent' => round(($totalPublished / $maxValue) * 100),
                'color'   => 'green',
            ],
            'draft' => [
                'label'   => 'Draft',
                'value'   => $totalDraft,
                'percent' => round(($totalDraft / $maxValue) * 100),
                'color'   => 'red',
            ],
        ];

        return view('dashboard', compact(
            'totalProjects',
            'totalCategories',
            'totalPublished',
            'totalDraft',
            'latestProjects',
            'summary',
        ));
    }
}
