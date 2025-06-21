<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Atur Pemesanan Kendaraan') }}
        </h2>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <form action="{{ route('admin.bookings.update', $booking) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <p class="text-md font-semibold">Detail Pemesanan:</p>
                    <p><strong>Pemesan:</strong> {{ $booking->user->name ?? 'N/A' }}</p>
                    <p><strong>Tujuan:</strong> {{ $booking->purpose }}</p>
                    <p><strong>Mulai:</strong> {{ $booking->start_date->format('d M Y H:i') }}</p>
                    <p><strong>Selesai:</strong> {{ $booking->end_date->format('d M Y H:i') }}</p>
                    <p><strong>Status Saat Ini:</strong> <span class="font-bold">{{ ucfirst(str_replace('_', ' ', $booking->status)) }}</span></p>
                </div>

                <div class="mb-4">
                    <x-input-label for="vehicle_id" :value="__('Pilih Kendaraan')" />
                    <select id="vehicle_id" name="vehicle_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        <option value="">-- Pilih Kendaraan --</option>
                        @foreach ($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}" {{ old('vehicle_id', $booking->vehicle_id) == $vehicle->id ? 'selected' : '' }}>
                                {{ $vehicle->plate_number }} ({{ $vehicle->brand }} {{ $vehicle->model }})
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('vehicle_id')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-input-label for="driver_id" :value="__('Pilih Driver')" />
                    <select id="driver_id" name="driver_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        <option value="">-- Pilih Driver --</option>
                        @foreach ($drivers as $driver)
                            <option value="{{ $driver->id }}" {{ old('driver_id', $booking->driver_id) == $driver->id ? 'selected' : '' }}>
                                {{ $driver->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('driver_id')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-input-label for="status" :value="__('Ubah Status Pemesanan')" />
                    <select id="status" name="status" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                        <option value="pending" {{ old('status', $booking->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved_level_1" {{ old('status', $booking->status) == 'approved_level_1' ? 'selected' : '' }}>Disetujui Level 1</option>
                        <option value="approved_level_2" {{ old('status', $booking->status) == 'approved_level_2' ? 'selected' : '' }}>Disetujui Level 2</option>
                        <option value="rejected" {{ old('status', $booking->status) == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        <option value="completed" {{ old('status', $booking->status) == 'completed' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button>
                        {{ __('Perbarui Pemesanan') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

