<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    // Manajemen Kendaraan
    public function index(Request $request)
    {
        $vehicles = Vehicle::query();
        if ($request->has('search')) {
            $vehicles->where('plate_number', 'like', '%' . $request->search . '%')
                     ->orWhere('type', 'like', '%' . $request->search . '%');
        }
        $vehicles = $vehicles->paginate(10);
        return view('admin.vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        return view('admin.vehicles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'plate_number' => ['required', 'string', 'max:255', 'unique:vehicles'],
            'type' => ['required', 'string', Rule::in(['Angkutan Orang', 'Angkutan Barang'])],
            'brand' => ['nullable', 'string', 'max:255'],
            'model' => ['nullable', 'string', 'max:255'],
            'ownership_type' => ['required', 'string', Rule::in(['Milik Perusahaan', 'Sewa'])],
            'description' => ['nullable', 'string'],
        ]);

        Vehicle::create($request->all());

        return redirect()->route('admin.vehicles.index')->with('success', 'Kendaraan berhasil ditambahkan.');
    }

    public function edit(Vehicle $vehicle)
    {
        return view('admin.vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'plate_number' => ['required', 'string', 'max:255', Rule::unique('vehicles')->ignore($vehicle->id)],
            'type' => ['required', 'string', Rule::in(['Angkutan Orang', 'Angkutan Barang'])],
            'brand' => ['nullable', 'string', 'max:255'],
            'model' => ['nullable', 'string', 'max:255'],
            'ownership_type' => ['required', 'string', Rule::in(['Milik Perusahaan', 'Sewa'])],
            'description' => ['nullable', 'string'],
        ]);

        $vehicle->update($request->all());

        return redirect()->route('admin.vehicles.index')->with('success', 'Kendaraan berhasil diperbarui.');
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('admin.vehicles.index')->with('success', 'Kendaraan berhasil dihapus.');
    }

    // Manajemen Pengguna (Role)
    public function usersIndex()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function updateUserRole(Request $request, User $user)
    {
        $request->validate([
            'role' => ['required', 'string', Rule::in(['admin', 'approver_level_1', 'approver_level_2', 'user'])],
        ]);

        $user->update(['role' => $request->role]);

        return redirect()->route('admin.users.index')->with('success', 'Role pengguna berhasil diperbarui.');
    }

    // Manajemen Pemesanan oleh Admin
    public function bookingsIndex(Request $request)
    {
        $bookings = Booking::with(['user', 'vehicle', 'driver'])->latest()->paginate(10);
        return view('admin.bookings.index', compact('bookings'));
    }

    public function editBooking(Booking $booking)
    {
        $drivers = User::where('role', 'user')->get(); // Anggap driver adalah user biasa
        $vehicles = Vehicle::all();
        return view('admin.bookings.edit', compact('booking', 'drivers', 'vehicles'));
    }

    public function updateBooking(Request $request, Booking $booking)
    {
        $request->validate([
            'vehicle_id' => ['nullable', 'exists:vehicles,id'],
            'driver_id' => ['nullable', 'exists:users,id'],
            'status' => ['required', 'string', Rule::in(['pending', 'approved_level_1', 'approved_level_2', 'rejected', 'completed'])],
        ]);

        $booking->update($request->only(['vehicle_id', 'driver_id', 'status']));

        return redirect()->route('admin.bookings.index')->with('success', 'Pemesanan berhasil diperbarui.');
    }
}
