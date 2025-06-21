<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Contoh data untuk grafik pemakaian kendaraan
        // Anda bisa memodifikasi ini sesuai kebutuhan (misal: berdasarkan jenis kendaraan, bulan, dll.)
        $monthlyBookings = Booking::select(
                DB::raw('MONTH(start_date) as month'),
                DB::raw('COUNT(*) as total_bookings')
            )
            ->whereYear('start_date', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $labels = [];
        $data = [];
        foreach ($monthlyBookings as $booking) {
            $labels[] = date('F', mktime(0, 0, 0, $booking->month, 10)); // Nama bulan
            $data[] = $booking->total_bookings;
        }

        // Contoh statistik lainnya
        $totalBookings = Booking::count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        $approvedBookings = Booking::where('status', 'approved_level_2')->count();

        return view('dashboard', compact('labels', 'data', 'totalBookings', 'pendingBookings', 'approvedBookings'));
    }
}
