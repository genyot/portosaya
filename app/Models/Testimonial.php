<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'name',
        'role',
        'message',
        'photo',
        'rating',
        'order',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];

    /**
     * URL foto testimoni (atau null).
     */
    public function getPhotoUrlAttribute(): ?string
    {
        return $this->photo
            ? asset('storage/'.$this->photo)
            : null;
    }
}
