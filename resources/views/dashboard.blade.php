<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <h3 class="text-lg font-bold mb-4">Statistik Pemesanan Kendaraan</h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div class="bg-blue-100 p-4 rounded-lg shadow">
                    <p class="text-sm text-gray-600">Total Pemesanan</p>
                    <p class="text-2xl font-bold text-blue-800">{{ $totalBookings }}</p>
                </div>
                <div class="bg-yellow-100 p-4 rounded-lg shadow">
                    <p class="text-sm text-gray-600">Pemesanan Menunggu</p>
                    <p class="text-2xl font-bold text-yellow-800">{{ $pendingBookings }}</p>
                </div>
                <div class="bg-green-100 p-4 rounded-lg shadow">
                    <p class="text-sm text-gray-600">Pemesanan Disetujui</p>
                    <p class="text-2xl font-bold text-green-800">{{ $approvedBookings }}</p>
                </div>
            </div>

            <h3 class="text-lg font-bold mb-4">Grafik Pemakaian Kendaraan (Tahun Ini)</h3>
            <div class="w-full h-96">
                <canvas id="usageChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Panggil fungsi yang di-ekspor dari dashboardChart.js
            // Pastikan data ini di-pass dengan benar dari controller
            window.drawDashboardChart(@json($labels), @json($data));
        });
    </script>
</x-app-layout>

