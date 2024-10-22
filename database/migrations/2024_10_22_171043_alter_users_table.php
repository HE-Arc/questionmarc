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
            $table->dropColumn("email");
            $table->dropColumn("email_verified_at");
            $table->renameColumn("name", "username");
            $table->unique("username");
            $table->string("filiere", 10);
            $table->integer("year");
            $table->string("profile_picture");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->renameColumn('username', 'name');
            $table->dropColumn('filiere');
            $table->dropColumn('year');
            $table->dropColumn('profile_picture');
        });
    }
};
