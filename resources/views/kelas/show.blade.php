<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Detail Kelas</h2>
                <p class="text-sm text-gray-600 mt-1">Informasi lengkap kelas</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('kelas.edit', $kelas->id) }}"
                   class="px-4 py-2 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition text-sm font-medium">
                    Edit Kelas
                </a>
                <a href="{{ route('kelas.index') }}" 
                   class="text-sm font-medium text-gray-600 hover:text-gray-900">
                    ← Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-xl mx-auto">
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-900">Informasi Kelas</h3>
                </div>
                
                <div class="p-6">
                    <div class="space-y-6">
                        {{-- Informasi Kelas --}}
                        <div class="grid grid-cols-2 gap-6">
                            <div class="bg-gray-50 p-4 rounded-xl">
                                <label class="text-sm font-medium text-gray-500">ID Kelas</label>
                                <p class="mt-1 text-lg font-semibold text-gray-900">{{ $kelas->id }}</p>
                            </div>
                            
                            <div class="bg-gray-50 p-4 rounded-xl">
                                <label class="text-sm font-medium text-gray-500">Level Kelas</label>
                                <p class="mt-1">
                                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-blue-100 text-blue-800 text-lg font-bold">
                                        {{ $kelas->level_kelas }}
                                    </span>
                                </p>
                            </div>
                        </div>

                        {{-- Nama Kelas --}}
                        <div>
                            <label class="text-sm font-medium text-gray-500">Nama Kelas</label>
                            <div class="mt-2 p-3 bg-blue-50 border border-blue-100 rounded-xl">
                                <p class="text-xl font-bold text-blue-800">{{ $kelas->nama_kelas }}</p>
                            </div>
                        </div>

                        {{-- Jurusan --}}
                        <div>
                            <label class="text-sm font-medium text-gray-500">Jurusan</label>
                            <div class="mt-2 p-3 bg-green-50 border border-green-100 rounded-xl">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                    <span class="text-lg font-semibold text-green-800">
                                        {{ $kelas->jurusan->nama_jurusan }}
                                    </span>
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
                                        {{ $kelas->created_at->format('d M Y') }}
                                    </p>
                                </div>
                                <div class="p-3 bg-gray-50 rounded-lg">
                                    <p class="text-sm text-gray-500">Terakhir Diupdate</p>
                                    <p class="text-sm font-medium text-gray-900">
                                        {{ $kelas->updated_at->format('d M Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex justify-between gap-3 mt-8 pt-6 border-t border-gray-200">
                        <a href="{{ route('kelas.index') }}"
                           class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition font-medium flex-1 text-center">
                            Kembali ke Daftar
                        </a>
                        <a href="{{ route('kelas.edit', $kelas->id) }}"
                           class="px-6 py-3 bg-yellow-600 text-white rounded-xl hover:bg-yellow-700 transition font-medium flex-1 text-center">
                            Edit Kelas
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>