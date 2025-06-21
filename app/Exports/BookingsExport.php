<?php

namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BookingsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Booking::with(['user', 'vehicle', 'driver'])->get();
    }

    public function headings(): array
    {
        return [
            'ID Pemesanan',
            'Pegawai',
            'Kendaraan',
            'Nomor Plat',
            'Driver',
            'Mulai Tanggal',
            'Selesai Tanggal',
            'Tujuan',
            'Status',
            'Dibuat Pada',
        ];
    }

    public function map($booking): array
    {
        return [
            $booking->id,
            $booking->user->name ?? 'N/A',
            $booking->vehicle->brand . ' ' . $booking->vehicle->model ?? 'N/A',
            $booking->vehicle->plate_number ?? 'N/A',
            $booking->driver->name ?? 'Belum Ditentukan',
            $booking->start_date->format('Y-m-d H:i'),
            $booking->end_date->format('Y-m-d H:i'),
            $booking->purpose,
            $booking->status,
            $booking->created_at->format('Y-m-d H:i'),
        ];
    }
}
