<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vehicle;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vehicle::create([
            'plate_number' => 'B 1234 ABC',
            'type' => 'Angkutan Orang',
            'brand' => 'Toyota',
            'model' => 'Innova',
            'ownership_type' => 'Milik Perusahaan',
            'description' => 'Kendaraan operasional kantor pusat',
        ]);

        Vehicle::create([
            'plate_number' => 'D 5678 XYZ',
            'type' => 'Angkutan Barang',
            'brand' => 'Mitsubishi',
            'model' => 'Colt Diesel',
            'ownership_type' => 'Milik Perusahaan',
            'description' => 'Truk pengangkut logistik tambang',
        ]);

        Vehicle::create([
            'plate_number' => 'F 9101 LMN',
            'type' => 'Angkutan Orang',
            'brand' => 'Daihatsu',
            'model' => 'Xenia',
            'ownership_type' => 'Sewa',
            'description' => 'Kendaraan sewa untuk kunjungan lapangan',
        ]);
    }
}
