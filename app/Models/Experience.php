<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'position',
        'company',
        'start_year',
        'end_year',
        'description',
        'order',
    ];

    /**
     * Label periode, misal "2022 - 2024" atau "2022 - Sekarang".
     */
    public function getPeriodAttribute(): string
    {
        return $this->start_year.' - '.($this->end_year ?: 'Sekarang');
    }
}
