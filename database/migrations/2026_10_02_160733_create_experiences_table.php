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
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('position');            // Contoh: "Graphic Designer"
            $table->string('company');             // Contoh: "PT Kreatif Digital"
            $table->string('start_year', 4);       // Contoh: "2022"
            $table->string('end_year', 4)->nullable(); // Kosong = masih berjalan
            $table->text('description')->nullable();   // Deskripsi pekerjaan
            $table->integer('order')->default(0);      // Urutan tampil
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
