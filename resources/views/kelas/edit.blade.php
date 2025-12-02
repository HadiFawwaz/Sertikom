<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Edit Kelas</h2>
                <p class="text-sm text-gray-600 mt-1">Perbarui informasi kelas</p>
            </div>
            <a href="{{ route('kelas.index') }}" 
               class="text-sm font-medium text-gray-600 hover:text-gray-900">
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-xl mx-auto">
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-200 bg-gray-50">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">Edit: {{ $kelas->nama_kelas }}</h3>
                        <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-sm font-medium">
                            Level {{ $kelas->level_kelas }}
                        </span>
                    </div>
                </div>

                <form action="{{ route('kelas.update', $kelas->id) }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        {{-- Nama Kelas --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kelas</label>
                            <input type="text" name="nama_kelas"
                                   class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                   value="{{ old('nama_kelas', $kelas->nama_kelas) }}"
                                   required>
                        </div>

                        {{-- Level Kelas --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Level Kelas</label>
                            <input type="number" name="level_kelas"
                                   class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                   value="{{ old('level_kelas', $kelas->level_kelas) }}"
                                   min="1" max="12"
                                   required>
                            <p class="mt-1 text-sm text-gray-500">Masukkan angka 1-12 (SD: 1-6, SMP: 7-9, SMA: 10-12)</p>
                        </div>

                        {{-- Jurusan --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jurusan</label>
                            <select name="jurusan_id"
                                    class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                    required>
                                @foreach ($jurusan as $j)
                                    <option value="{{ $j->id }}" 
                                        {{ $kelas->jurusan_id == $j->id ? 'selected' : '' }}>
                                        {{ $j->nama_jurusan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-gray-200">
                        <a href="{{ route('kelas.show', $kelas->id) }}"
                           class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition font-medium">
                            Batal
                        </a>
                        <button type="submit"
                                class="px-6 py-3 bg-gray-900 text-white rounded-xl hover:bg-gray-800 transition font-medium flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Update Kelas
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>