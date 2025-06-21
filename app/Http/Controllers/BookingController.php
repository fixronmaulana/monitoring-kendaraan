<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Approval;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = auth()->user(); // Ambil user dan berikan type hint
        $bookings = $user->bookings() // Sekarang $user diketahui sebagai instance User
            ->with(['vehicle', 'driver', 'approvals'])
            ->latest()
            ->paginate(10);

        return view('bookings.my', compact('bookings'));
    }

    public function create()
    {
        return view('bookings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'start_date' => ['required', 'date', 'after_or_equal:now'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'purpose' => ['required', 'string', 'max:500'],
        ]);

        /** @var \App\Models\User $user */
        $user = auth()->user();
        $booking = $user->bookings()->create([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'purpose' => $request->purpose,
            'status' => 'pending',
        ]);

        // Otomatis buat entri approval untuk level 1 dan 2
        $approverLevel1 = User::where('role', 'approver_level_1')->first();
        if ($approverLevel1) {
            $booking->approvals()->create([
                'approver_id' => $approverLevel1->id,
                'level' => 1,
                'status' => 'pending',
            ]);
        }

        $approverLevel2 = User::where('role', 'approver_level_2')->first();
        if ($approverLevel2) {
            $booking->approvals()->create([
                'approver_id' => $approverLevel2->id,
                'level' => 2,
                'status' => 'pending',
            ]);
        }

        return redirect()->route('bookings.my')->with('success', 'Pemesanan berhasil diajukan, menunggu persetujuan.');
    }
}
