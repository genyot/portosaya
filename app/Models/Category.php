<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Mengizinkan kolom name dan slug diisi
    protected $fillable = [
        'name',
        'slug',
    ];
}