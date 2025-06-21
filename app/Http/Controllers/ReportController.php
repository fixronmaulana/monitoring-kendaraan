<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BookingsExport;

class ReportController extends Controller
{
    public function bookingReports(Request $request)
    {
        $bookings = Booking::with(['user', 'vehicle', 'driver'])
                            ->latest()
                            ->paginate(10); // Atau sesuai filter yang Anda inginkan
        return view('reports.bookings', compact('bookings'));
    }

    public function exportBookingReports()
    {
        return Excel::download(new BookingsExport, 'laporan_pemesanan_kendaraan.xlsx');
    }
}
