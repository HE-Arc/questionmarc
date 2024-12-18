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
        // Supprime la table 'users_modules_askable'
        Schema::dropIfExists('users_modules_askable');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remonte la table si elle est supprimée
        Schema::create('users_modules_askable', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');
            $table->foreignId('module_id')
                  ->constrained('modules')
                  ->onDelete('cascade');
            $table->unique(['user_id', 'module_id']);
        });
    }
};
