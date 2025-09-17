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
         Schema::table('user_logs', function (Blueprint $table) {
            // Change the url column to TEXT
            $table->text('url')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('user_logs', function (Blueprint $table) {
            // Revert to VARCHAR(255) in case of rollback
            $table->string('url', 255)->change();
        });
    }
};
