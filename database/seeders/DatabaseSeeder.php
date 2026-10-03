<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Akun admin tunggal (web portofolio)
        User::firstOrCreate(
            ['email' => 'ridhoramdana985@gmail.com'],
            [
                'name'              => 'Ridho Ramdana',
                'password'          => Hash::make('genyot1234'),
                'email_verified_at' => now(),
            ]
        );
    }
}
