<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Persetujuan Pemesanan Level 2') }}
        </h2>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <h3 class="text-lg font-bold mb-4">Pemesanan Menunggu Persetujuan Anda (Level 2)</h3>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 rounded-lg overflow-hidden">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pemesan</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tujuan</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mulai</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Selesai</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Pemesanan</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($approvals as $approval)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $approval->booking->user->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $approval->booking->purpose }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $approval->booking->start_date->format('d M Y H:i') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $approval->booking->end_date->format('d M Y H:i') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        @if ($approval->booking->status == 'pending') bg-yellow-100 text-yellow-800
                                        @elseif ($approval->booking->status == 'approved_level_1') bg-blue-100 text-blue-800
                                        @elseif ($approval->booking->status == 'approved_level_2') bg-green-100 text-green-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ ucfirst(str_replace('_', ' ', $approval->booking->status)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <form action="{{ route('approvals.level2.update', $approval) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="approved">
                                        <x-primary-button class="bg-green-600 hover:bg-green-700 py-2 px-3 text-xs">
                                            {{ __('Setujui') }}
                                        </x-primary-button>
                                    </form>
                                    <form action="{{ route('approvals.level2.update', $approval) }}" method="POST" class="inline-block ml-2">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="rejected">
                                        <x-danger-button class="py-2 px-3 text-xs">
                                            {{ __('Tolak') }}
                                        </x-danger-button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">Tidak ada pemesanan menunggu persetujuan Level 2.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $approvals->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

