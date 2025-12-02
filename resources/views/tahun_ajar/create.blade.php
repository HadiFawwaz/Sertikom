<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Tambah Tahun Ajar Baru</h2>
                <p class="text-sm text-gray-600 mt-1">Isi form berikut untuk menambahkan data tahun ajar baru</p>
            </div>
            <a href="{{ route('tahun_ajar.index') }}" 
               class="text-sm font-medium text-gray-600 hover:text-gray-900">
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-xl mx-auto">
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-900">Form Data Tahun Ajar</h3>
                </div>

                <form action="{{ route('tahun_ajar.store') }}" method="POST" class="p-6">
                    @csrf

                    <div class="space-y-6">
                        {{-- Kode Tahun Ajar --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Kode Tahun Ajar <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="kode_tahun_ajar"
                                   class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                   placeholder="Contoh: 2024/2025"
                                   value="{{ old('kode_tahun_ajar') }}"
                                   required>
                            <p class="mt-1 text-sm text-gray-500">Format: TahunAjaran1/TahunAjaran2 (contoh: 2023/2024)</p>
                        </div>

                        {{-- Nama Tahun Ajar --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Tahun Ajar <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama_tahun_ajar"
                                   class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                   placeholder="Contoh: Tahun Ajaran 2024/2025"
                                   value="{{ old('nama_tahun_ajar') }}"
                                   required>
                            <p class="mt-1 text-sm text-gray-500">Nama lengkap tahun ajaran</p>
                        </div>

                        {{-- Status Tahun Ajar (Opsional) --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status Tahun Ajar</label>
                            <div class="flex items-center space-x-4 mt-2">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="status" value="aktif" checked 
                                           class="text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-gray-700">Aktif</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="status" value="tidak_aktif"
                                           class="text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-gray-700">Tidak Aktif</span>
                                </label>
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Pilih status tahun ajaran saat ini</p>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-gray-200">
                        <a href="{{ route('tahun_ajar.index') }}"
                           class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition font-medium">
                            Batal
                        </a>
                        <button type="submit"
                                class="px-6 py-3 bg-gray-900 text-white rounded-xl hover:bg-gray-800 transition font-medium flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                            </svg>
                            Simpan Tahun Ajar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>