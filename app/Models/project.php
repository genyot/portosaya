<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    // Mengizinkan pengisian massal untuk kolom-kolom ini
    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'year',
        'description',
        'tools',
        'project_link',
        'instagram_link',
        'image',
        'status',
    ];

    /**
     * Relasi ke Model Category
     * (Satu Karya dimiliki oleh Satu Kategori)
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}