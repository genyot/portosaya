<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'photo',
        'phone',
        'whatsapp',
        'instagram',
        'github',
        'linkedin',
        'dribbble',
        'cv_file',
        'tagline',
        'bio',
    ];

    /**
     * URL foto profile (atau null jika belum upload).
     */
    public function getPhotoUrlAttribute(): ?string
    {
        return $this->photo
            ? asset('storage/'.$this->photo)
            : null;
    }

    /**
     * URL file CV (atau null jika belum upload).
     */
    public function getCvUrlAttribute(): ?string
    {
        return $this->cv_file
            ? asset('storage/'.$this->cv_file)
            : null;
    }

    /**
     * Nomor WhatsApp dalam format internasional (untuk link wa.me).
     */
    public function getWhatsappLinkAttribute(): ?string
    {
        if (! $this->whatsapp) {
            return null;
        }

        // Bersihkan: hanya angka, ubah awalan 0 menjadi 62
        $number = preg_replace('/[^0-9]/', '', $this->whatsapp);

        if (str_starts_with($number, '0')) {
            $number = '62'.substr($number, 1);
        }

        return 'https://wa.me/'.$number;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
