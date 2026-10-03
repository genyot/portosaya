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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');                 // Nama pemberi testimoni
            $table->string('role')->nullable();     // Jabatan / perusahaan
            $table->text('message');                // Isi testimoni
            $table->string('photo')->nullable();    // Foto (opsional)
            $table->unsignedTinyInteger('rating')->default(5); // Bintang 1-5
            $table->integer('order')->default(0);   // Urutan tampil
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
