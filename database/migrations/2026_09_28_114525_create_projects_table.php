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
        Schema::create('projects', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('slug')->unique();
        
        // Relasi ke tabel kategori (Jika kategori dihapus, karya di dalamnya ikut terhapus)
        $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
        
        $table->string('year', 4);
        $table->text('description');
        $table->string('tools')->nullable(); // Opsional
        $table->string('project_link')->nullable(); // Opsional
        $table->string('instagram_link')->nullable(); // Opsional
        $table->string('image'); // Menyimpan nama file gambar
        $table->enum('status', ['Published', 'Draft'])->default('Published');
        
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
