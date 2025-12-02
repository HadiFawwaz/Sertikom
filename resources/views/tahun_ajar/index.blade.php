<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Data Tahun Ajar</h2>
                <p class="text-sm text-gray-600 mt-1">Kelola data tahun ajaran sekolah</p>
            </div>
            <a href="{{ route('tahun_ajar.create') }}"
               class="px-5 py-2.5 bg-gray-900 text-white rounded-xl hover:bg-gray-800 transition font-medium flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Tahun Ajar
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto">
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-900">Daftar Tahun Ajar</h3>
                        <span class="text-sm text-gray-500">
                            Total: {{ $tahunAjar->count() }} tahun ajaran
                        </span>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="p-4 text-left text-sm font-semibold text-gray-700">No</th>
                                <th class="p-4 text-left text-sm font-semibold text-gray-700">Kode Tahun Ajar</th>
                                <th class="p-4 text-left text-sm font-semibold text-gray-700">Nama Tahun Ajar</th>
                                <th class="p-4 text-left text-sm font-semibold text-gray-700">Status</th>
                                <th class="p-4 text-left text-sm font-semibold text-gray-700">Jumlah Siswa</th>
                                <th class="p-4 text-left text-sm font-semibold text-gray-700">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($tahunAjar as $tahun)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="p-4 text-sm text-gray-700">{{ $loop->iteration }}</td>
                                    <td class="p-4">
                                        <span class="inline-flex items-center justify-center px-3 py-1.5 rounded-lg bg-purple-50 text-purple-700 text-sm font-medium">
                                            {{ $tahun->kode_tahun_ajar }}
                                        </span>
                                    </td>
                                    <td class="p-4">
                                        <div class="font-medium text-gray-900">{{ $tahun->nama_tahun_ajar }}</div>
                                    </td>
                                    <td class="p-4">
                                        @if($tahun->status == 'aktif')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-50 text-green-700">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                Aktif
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-50 text-gray-700">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                                Tidak Aktif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="p-4">
                                        @if($tahun->siswa_count > 0)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-50 text-blue-700">
                                                {{ $tahun->siswa_count }} siswa
                                            </span>
                                        @else
                                            <span class="text-sm text-gray-400">Belum ada siswa</span>
                                        @endif
                                    </td>
                                    <td class="p-4">
                                        <div class="flex items-center gap-3">
                                            <a href="{{ route('tahun_ajar.show', $tahun) }}"
                                               class="text-blue-600 hover:text-blue-800 transition flex items-center text-sm font-medium"
                                               title="Detail">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                Detail
                                            </a>
                                            <a href="{{ route('tahun_ajar.edit', $tahun) }}"
                                               class="text-green-600 hover:text-green-800 transition flex items-center text-sm font-medium"
                                               title="Edit">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Edit
                                            </a>
                                            <form id="delete-form-{{ $tahun->id }}" 
                                                  action="{{ route('tahun_ajar.destroy', $tahun) }}" 
                                                  method="POST" 
                                                  class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                        onclick="confirmDelete(event, 'delete-form-{{ $tahun->id }}', '{{ $tahun->nama_tahun_ajar }}', 'tahun ajar')"
                                                        class="text-red-600 hover:text-red-800 transition flex items-center text-sm font-medium"
                                                        title="Hapus">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-8 text-center">
                                        <div class="flex flex-col items-center justify-center text-gray-400">
                                            <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            <p class="text-lg font-medium text-gray-500 mb-1">Belum ada data tahun ajar</p>
                                            <p class="text-sm text-gray-400">Mulai dengan menambahkan tahun ajar baru</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination jika ada --}}
                @if(method_exists($tahunAjar, 'links') && $tahunAjar->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $tahunAjar->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>