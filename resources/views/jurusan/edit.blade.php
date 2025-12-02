<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Edit Jurusan</h2>
                <p class="text-sm text-gray-600 mt-1">Perbarui informasi jurusan</p>
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
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">Edit: {{ $jurusan->nama_jurusan }}</h3>
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-medium">
                            {{ $jurusan->kode_jurusan }}
                        </span>
                    </div>
                </div>

                <form action="{{ route('jurusan.update', $jurusan->id) }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        {{-- Kode Jurusan --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kode Jurusan</label>
                            <input type="text" name="kode_jurusan"
                                   class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                   value="{{ old('kode_jurusan', $jurusan->kode_jurusan) }}"
                                   placeholder="Contoh: IPA, IPS, TKJ"
                                   required>
                        </div>

                        {{-- Nama Jurusan --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Jurusan</label>
                            <input type="text" name="nama_jurusan"
                                   class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                   value="{{ old('nama_jurusan', $jurusan->nama_jurusan) }}"
                                   placeholder="Contoh: Ilmu Pengetahuan Alam"
                                   required>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex justify-between gap-3 mt-8 pt-6 border-t border-gray-200">
                        <div class="flex gap-3">
                            <form id="delete-form-{{ $jurusan->id }}" 
                                  action="{{ route('jurusan.destroy', $jurusan->id) }}" 
                                  method="POST" 
                                  class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                        onclick="confirmDelete(event, 'delete-form-{{ $jurusan->id }}', '{{ $jurusan->nama_jurusan }}', 'jurusan')"
                                        class="px-6 py-3 border border-red-300 text-red-600 rounded-xl hover:bg-red-50 transition font-medium flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                            
                            <a href="{{ route('jurusan.show', $jurusan->id) }}"
                               class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition font-medium">
                                Batal
                            </a>
                        </div>
                        
                        <button type="submit"
                                class="px-6 py-3 bg-gray-900 text-white rounded-xl hover:bg-gray-800 transition font-medium flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Update Jurusan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>