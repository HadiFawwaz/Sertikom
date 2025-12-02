<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Detail Jurusan</h2>
                <p class="text-sm text-gray-600 mt-1">Informasi lengkap jurusan</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('jurusan.edit', $jurusan->id) }}"
                   class="px-4 py-2 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition text-sm font-medium">
                    Edit Jurusan
                </a>
                <a href="{{ route('jurusan.index') }}" 
                   class="text-sm font-medium text-gray-600 hover:text-gray-900">
                    ← Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-lg mx-auto">
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-900">Informasi Jurusan</h3>
                </div>
                
                <div class="p-6">
                    <div class="space-y-6">
                        {{-- Kode Jurusan --}}
                        <div class="bg-blue-50 p-4 rounded-xl">
                            <label class="text-sm font-medium text-gray-500">Kode Jurusan</label>
                            <p class="mt-1 text-xl font-bold text-blue-800">{{ $jurusan->kode_jurusan }}</p>
                        </div>

                        {{-- Nama Jurusan --}}
                        <div class="bg-green-50 p-4 rounded-xl">
                            <label class="text-sm font-medium text-gray-500">Nama Jurusan</label>
                            <p class="mt-1 text-xl font-bold text-green-800">{{ $jurusan->nama_jurusan }}</p>
                        </div>

                        {{-- Statistik --}}
                        <div class="pt-6 border-t border-gray-200">
                            <label class="text-sm font-medium text-gray-500">Statistik</label>
                            <div class="mt-4 grid grid-cols-2 gap-4">
                                <div class="bg-gray-50 p-4 rounded-lg text-center">
                                    <p class="text-2xl font-bold text-gray-900">{{ $jurusan->kelas_count ?? 0 }}</p>
                                    <p class="text-sm text-gray-500">Total Kelas</p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg text-center">
                                    <p class="text-2xl font-bold text-gray-900">{{ $jurusan->siswa_count ?? 0 }}</p>
                                    <p class="text-sm text-gray-500">Total Siswa</p>
                                </div>
                            </div>
                        </div>

                        {{-- Info Tambahan --}}
                        <div class="pt-6 border-t border-gray-200">
                            <label class="text-sm font-medium text-gray-500">Informasi Tambahan</label>
                            <div class="mt-2 grid grid-cols-2 gap-4">
                                <div class="p-3 bg-gray-50 rounded-lg">
                                    <p class="text-sm text-gray-500">Tanggal Dibuat</p>
                                    <p class="text-sm font-medium text-gray-900">
                                        {{ $jurusan->created_at->format('d M Y') }}
                                    </p>
                                </div>
                                <div class="p-3 bg-gray-50 rounded-lg">
                                    <p class="text-sm text-gray-500">Terakhir Diupdate</p>
                                    <p class="text-sm font-medium text-gray-900">
                                        {{ $jurusan->updated_at->format('d M Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex justify-between gap-3 mt-8 pt-6 border-t border-gray-200">
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
                        
                        <div class="flex gap-3">
                            <a href="{{ route('jurusan.index') }}"
                               class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition font-medium">
                                Kembali
                            </a>
                            <a href="{{ route('jurusan.edit', $jurusan->id) }}"
                               class="px-6 py-3 bg-gray-900 text-white rounded-xl hover:bg-gray-800 transition font-medium">
                                Edit Jurusan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>