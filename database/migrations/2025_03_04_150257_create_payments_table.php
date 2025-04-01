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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            // $table->renameColumn('id','payment_id');
            $table->integer('student_id')->nullable();
            $table->timestamps();
            $table->string('full_name');
            $table->decimal('amount', 10, 2)->default(0);
            $table->decimal('total_balance', 10, 2)->default(0);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
