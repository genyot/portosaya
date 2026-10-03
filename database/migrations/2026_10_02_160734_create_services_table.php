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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');               // Contoh: "Web Development"
            $table->string('icon')->nullable();    // Contoh: "bi-code-slash" (Bootstrap Icons)
            $table->text('description')->nullable(); // Deskripsi layanan
            $table->integer('order')->default(0);  // Urutan tampil
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
