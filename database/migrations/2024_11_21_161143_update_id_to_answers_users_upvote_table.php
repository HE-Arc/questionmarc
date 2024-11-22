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
        Schema::table('answers_users_upvote', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['answer_id']);
            $table->dropUnique('answers_users_upvote_user_id_answer_id_unique');

            $table->unsignedBigInteger('id')->nullable()->change();
            $table->dropPrimary('id');
            $table->dropColumn('id');

            $table->primary(['user_id', 'answer_id']);

            $table->foreign('answer_id')->references('id')->on('answers')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('answers_users_upvote', function (Blueprint $table) {
            $table->dropPrimary(['user_id', 'answer_id']);

            $table->id();

            $table->unique(['user_id', 'answer_id']);

            $table->primary('id');
        });
    }
};
