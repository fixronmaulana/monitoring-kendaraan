<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Approval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
    public function indexLevel1()
    {
        /** @var \App\Models\User $user */
        $user = auth()->user(); // Ambil user dan berikan type hint
        $approvals = $user->approvals() // Sekarang $user diketahui sebagai instance User
            ->where('level', 1)
            ->with('booking.user')
            ->whereHas('booking', function ($query) {
                $query->where('status', 'pending');
            })
            ->latest()
            ->paginate(10);

        return view('approvals.level1_index', compact('approvals'));
    }

    public function approveRejectLevel1(Request $request, Approval $approval)
    {
        $request->validate([
            'status' => ['required', 'string', 'in:approved,rejected'],
            'notes' => ['nullable', 'string'],
        ]);

        if ($approval->approver_id !== Auth::id() || $approval->level !== 1) {
            abort(403, 'Anda tidak memiliki izin untuk menyetujui pemesanan ini.');
        }

        $booking = $approval->booking;

        if ($booking->status !== 'pending') {
            return redirect()->back()->with('error', 'Pemesanan ini sudah diproses.');
        }

        $approval->update([
            'status' => $request->status,
            'notes' => $request->notes,
        ]);

        if ($request->status === 'approved') {
            $booking->update(['status' => 'approved_level_1']);
            return redirect()->route('approvals.level1.index')->with('success', 'Pemesanan berhasil disetujui di Level 1.');
        } else {
            $booking->update(['status' => 'rejected']);
            return redirect()->route('approvals.level1.index')->with('error', 'Pemesanan ditolak di Level 1.');
        }
    }

    public function indexLevel2()
    {
        /** @var \App\Models\User $user */
        $user = auth()->user(); // Ambil user dan berikan type hint
        $approvals = $user->approvals() // Sekarang $user diketahui sebagai instance User
            ->where('level', 2)
            ->with('booking.user')
            ->whereHas('booking', function ($query) {
                $query->where('status', 'approved_level_1');
            })
            ->latest()
            ->paginate(10);

        return view('approvals.level2_index', compact('approvals'));
    }


    public function approveRejectLevel2(Request $request, Approval $approval)
    {
        $request->validate([
            'status' => ['required', 'string', 'in:approved,rejected'],
            'notes' => ['nullable', 'string'],
        ]);

        if ($approval->approver_id !== Auth::id() || $approval->level !== 2) {
            abort(403, 'Anda tidak memiliki izin untuk menyetujui pemesanan ini.');
        }

        $booking = $approval->booking;

        if ($booking->status !== 'approved_level_1') {
            return redirect()->back()->with('error', 'Pemesanan ini belum disetujui di Level 1 atau sudah diproses.');
        }

        $approval->update([
            'status' => $request->status,
            'notes' => $request->notes,
        ]);

        if ($request->status === 'approved') {
            $booking->update(['status' => 'approved_level_2']);
            return redirect()->route('approvals.level2.index')->with('success', 'Pemesanan berhasil disetujui di Level 2.');
        } else {
            $booking->update(['status' => 'rejected']);
            return redirect()->route('approvals.level2.index')->with('error', 'Pemesanan ditolak di Level 2.');
        }
    }
}
