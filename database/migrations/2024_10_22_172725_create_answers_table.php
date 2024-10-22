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
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->constrained('users');
            $table->foreignId('question_id')->constrained('questions')->onDelete('cascade');
            $table->string("content")->nullable(false);
            $table->date("created_date")->nullable(false);
            $table->boolean("validated");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
