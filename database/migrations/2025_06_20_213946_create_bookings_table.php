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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users'); // Pegawai yang memesan
            $table->foreignId('vehicle_id')->nullable()->constrained('vehicles'); // Kendaraan yang dipesan (bisa null jika belum ditentukan admin)
            $table->foreignId('driver_id')->nullable()->constrained('users'); // Driver (jika ada)
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->text('purpose'); // Tujuan pemakaian
            $table->string('status')->default('pending'); // pending, approved_level_1, approved_level_2, rejected, completed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
