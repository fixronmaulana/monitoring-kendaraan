<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pemesanan Kendaraan Saya') }}
        </h2>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            @if ($bookings->isEmpty())
                <p class="text-gray-600">Anda belum memiliki riwayat pemesanan kendaraan.</p>
                <div class="mt-4">
                    <x-primary-button href="{{ route('bookings.create') }}">
                        {{ __('Buat Pemesanan Sekarang') }}
                    </x-primary-button>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 rounded-lg overflow-hidden">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tujuan</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Mulai</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Selesai</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kendaraan</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Driver</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Persetujuan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($bookings as $booking)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $booking->purpose }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $booking->start_date->format('d M Y H:i') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $booking->end_date->format('d M Y H:i') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $booking->vehicle ? $booking->vehicle->brand . ' ' . $booking->vehicle->model . ' (' . $booking->vehicle->plate_number . ')' : 'Belum Ditentukan' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $booking->driver ? $booking->driver->name : 'Belum Ditentukan' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            @if ($booking->status == 'pending') bg-yellow-100 text-yellow-800
                                            @elseif ($booking->status == 'approved_level_1') bg-blue-100 text-blue-800
                                            @elseif ($booking->status == 'approved_level_2') bg-green-100 text-green-800
                                            @else bg-red-100 text-red-800 @endif">
                                            {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @foreach ($booking->approvals as $approval)
                                            <p class="text-sm">Level {{ $approval->level }}:
                                                <span
                                                    class="font-medium
                                                    @if ($approval->status == 'pending') text-yellow-600
                                                    @elseif ($approval->status == 'approved') text-green-600
                                                    @else text-red-600 @endif">
                                                    {{ ucfirst($approval->status) }}
                                                </span>
                                                ({{ $approval->approver->name ?? 'N/A' }})
                                            </p>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $bookings->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
