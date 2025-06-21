<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Pemesanan Kendaraan Baru') }}
        </h2>
    </x-slot>

    <style>
        input[type="datetime-local"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
        }
    </style>


    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <form action="{{ route('bookings.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <x-input-label for="start_date" :value="__('Tanggal & Waktu Mulai')" />
                    <x-text-input cla id="start_date" class="block mt-1 w-full" type="datetime-local" name="start_date"
                        :value="old('start_date')" required autofocus />
                    <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-input-label for="end_date" :value="__('Tanggal & Waktu Selesai')" />
                    <x-text-input id="end_date" class="block mt-1 w-full" type="datetime-local" name="end_date"
                        :value="old('end_date')" required />
                    <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-input-label for="purpose" :value="__('Tujuan Pemakaian')" />
                    <textarea id="purpose" name="purpose" rows="4"
                        class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('purpose') }}</textarea>
                    <x-input-error :messages="$errors->get('purpose')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button>
                        {{ __('Ajukan Pemesanan') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
