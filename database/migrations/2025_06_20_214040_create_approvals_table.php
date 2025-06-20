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
        Schema::create('approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings');
            $table->foreignId('approver_id')->constrained('users'); // Pihak yang menyetujui
            $table->integer('level'); // Level persetujuan (1, 2, dst.)
            $table->string('status')->default('pending'); // pending, approved, rejected
            $table->text('notes')->nullable(); // Catatan dari persetujuan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approvals');
    }
};
