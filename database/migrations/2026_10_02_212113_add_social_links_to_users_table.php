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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->string('whatsapp')->nullable()->after('phone');
            $table->string('instagram')->nullable()->after('whatsapp');
            $table->string('github')->nullable()->after('instagram');
            $table->string('linkedin')->nullable()->after('github');
            $table->string('dribbble')->nullable()->after('linkedin');
            $table->string('cv_file')->nullable()->after('dribbble');
            $table->string('tagline')->nullable()->after('cv_file');
            $table->text('bio')->nullable()->after('tagline');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone', 'whatsapp', 'instagram', 'github',
                'linkedin', 'dribbble', 'cv_file', 'tagline', 'bio',
            ]);
        });
    }
};
