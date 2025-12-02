<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Tambah Jurusan Baru</h2>
                <p class="text-sm text-gray-600 mt-1">Isi form berikut untuk menambahkan data jurusan baru</p>
            </div>
            <a href="{{ route('jurusan.index') }}" 
               class="text-sm font-medium text-gray-600 hover:text-gray-900">
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-lg mx-auto">
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-900">Form Data Jurusan</h3>
                </div>

                <form action="{{ route('jurusan.store') }}" method="POST" class="p-6">
                    @csrf

                    <div class="space-y-6">
                        {{-- Kode Jurusan --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Kode Jurusan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="kode_jurusan"
                                   class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                   placeholder="Contoh: IPA, IPS, TKJ"
                                   value="{{ old('kode_jurusan') }}"
                                   required>
                            <p class="mt-1 text-sm text-gray-500">Kode singkat untuk identifikasi jurusan</p>
                        </div>

                        {{-- Nama Jurusan --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Jurusan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama_jurusan"
                                   class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                   placeholder="Contoh: Ilmu Pengetahuan Alam"
                                   value="{{ old('nama_jurusan') }}"
                                   required>
                            <p class="mt-1 text-sm text-gray-500">Nama lengkap jurusan</p>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-gray-200">
                        <a href="{{ route('jurusan.index') }}"
                           class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition font-medium">
                            Batal
                        </a>
                        <button type="submit"
                                class="px-6 py-3 bg-gray-900 text-white rounded-xl hover:bg-gray-800 transition font-medium flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                            </svg>
                            Simpan Jurusan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>