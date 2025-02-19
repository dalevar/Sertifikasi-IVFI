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
            $table->foreignId('user_id')->constrained('users');
            // $table->bigInteger('user_id');
            $table->bigInteger('total_members');
            $table->bigInteger('total_amount');
            $table->enum('status', ['pending', 'paid', 'failed']);
            $table->date('date');
            $table->enum('validation', ['pending', 'validated', 'rejected']);
            $table->timestamps();
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
