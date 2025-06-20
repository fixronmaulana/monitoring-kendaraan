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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('plate_number')->unique(); // Nomor plat kendaraan
            $table->string('type'); // Angkutan orang / Angkutan barang
            $table->string('brand')->nullable(); // Merek kendaraan
            $table->string('model')->nullable(); // Model kendaraan
            $table->string('ownership_type'); // Milik Perusahaan / Sewa
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
