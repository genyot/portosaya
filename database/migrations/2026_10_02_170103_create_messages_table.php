<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');                  // Nama pengirim
            $table->string('email');                 // Email pengirim
            $table->string('subject')->nullable();   // Subjek (opsional)
            $table->text('message');                 // Isi pesan
            $table->boolean('is_read')->default(false); // Sudah dibaca admin?
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
