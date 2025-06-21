<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Kendaraan Baru') }}
        </h2>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <form action="{{ route('admin.vehicles.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <x-input-label for="plate_number" :value="__('Nomor Plat')" />
                    <x-text-input id="plate_number" class="block mt-1 w-full" type="text" name="plate_number" :value="old('plate_number')" required autofocus />
                    <x-input-error :messages="$errors->get('plate_number')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-input-label for="type" :value="__('Tipe Kendaraan')" />
                    <select id="type" name="type" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                        <option value="">Pilih Tipe</option>
                        <option value="Angkutan Orang" {{ old('type') == 'Angkutan Orang' ? 'selected' : '' }}>Angkutan Orang</option>
                        <option value="Angkutan Barang" {{ old('type') == 'Angkutan Barang' ? 'selected' : '' }}>Angkutan Barang</option>
                    </select>
                    <x-input-error :messages="$errors->get('type')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-input-label for="brand" :value="__('Merek')" />
                    <x-text-input id="brand" class="block mt-1 w-full" type="text" name="brand" :value="old('brand')" />
                    <x-input-error :messages="$errors->get('brand')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-input-label for="model" :value="__('Model')" />
                    <x-text-input id="model" class="block mt-1 w-full" type="text" name="model" :value="old('model')" />
                    <x-input-error :messages="$errors->get('model')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-input-label for="ownership_type" :value="__('Tipe Kepemilikan')" />
                    <select id="ownership_type" name="ownership_type" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                        <option value="">Pilih Kepemilikan</option>
                        <option value="Milik Perusahaan" {{ old('ownership_type') == 'Milik Perusahaan' ? 'selected' : '' }}>Milik Perusahaan</option>
                        <option value="Sewa" {{ old('ownership_type') == 'Sewa' ? 'selected' : '' }}>Sewa</option>
                    </select>
                    <x-input-error :messages="$errors->get('ownership_type')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-input-label for="description" :value="__('Deskripsi (Opsional)')" />
                    <textarea id="description" name="description" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button>
                        {{ __('Simpan Kendaraan') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

