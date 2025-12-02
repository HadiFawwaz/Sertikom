<x-app-layout>

    <div class="py-8 w-full px-4 md:px-6">

        {{-- ===== HEADER ===== --}}
        <div class="mb-8">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Dashboard</h1>
            <p class="text-gray-600 mt-2">Kelola data siswa dan informasi akademik</p>
        </div>

        {{-- ===== STATISTICS CARDS ===== --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            {{-- Total Siswa Card --}}
            <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center">
                    <div class="flex-shrink-0 w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5 3.75a3.5 3.5 0 01-4.95 0 3.5 3.5 0 014.95 0z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Siswa</p>
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $totalSiswa ?? 0 }}</p>
                    </div>
                </div>
            </div>

            {{-- Total Kelas Card --}}
            <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center">
                    <div class="flex-shrink-0 w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Kelas</p>
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $totalKelas ?? 0 }}</p>
                    </div>
                </div>
            </div>

            {{-- Total Jurusan Card --}}
            <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center">
                    <div class="flex-shrink-0 w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Jurusan</p>
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $totalJurusan ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== FILTER SECTION ===== --}}
        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm mb-8">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Filter Data Siswa</h2>
            <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                {{-- Search Input --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cari Siswa</label>
                    <input type="text" name="search" placeholder="Masukkan NISN atau nama..."
                        class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        value="{{ $search ?? '' }}">
                </div>

                {{-- Kelas Filter --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Filter Kelas</label>
                    <select name="kelas_id" class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        <option value="">Semua Kelas</option>
                        @foreach($kelasList as $k)
                            <option value="{{ $k->id }}" @selected($kelasId == $k->id)>
                                {{ $k->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Jurusan Filter --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Filter Jurusan</label>
                    <select name="jurusan_id" class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        <option value="">Semua Jurusan</option>
                        @foreach($jurusanList as $j)
                            <option value="{{ $j->id }}" @selected($jurusanId == $j->id)>
                                {{ $j->nama_jurusan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Action Buttons --}}
                <div class="flex items-end gap-3">
                    <a href="{{ route('dashboard') }}"
                        class="px-5 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition flex-1 text-center font-medium">
                        Reset
                    </a>
                    <button type="submit"
                        class="px-5 py-3 bg-gray-900 text-white rounded-xl hover:bg-gray-800 transition flex-1 font-medium">
                        Terapkan
                    </button>
                </div>
            </form>
        </div>

        {{-- ===== DATA TABLE SECTION ===== --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-900">Daftar Siswa</h2>
                    <span class="text-sm text-gray-500">
                        Menampilkan {{ $siswas->firstItem() ?? 0 }}-{{ $siswas->lastItem() ?? 0 }} dari {{ $siswas->total() }} data
                    </span>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="p-4 text-left text-sm font-semibold text-gray-700">No</th>
                            <th class="p-4 text-left text-sm font-semibold text-gray-700">NISN</th>
                            <th class="p-4 text-left text-sm font-semibold text-gray-700">Nama Siswa</th>
                            <th class="p-4 text-left text-sm font-semibold text-gray-700">Kelas</th>
                            <th class="p-4 text-left text-sm font-semibold text-gray-700">Jurusan</th>
                            <th class="p-4 text-left text-sm font-semibold text-gray-700">Tahun Ajar</th>
                            <th class="p-4 text-left text-sm font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($siswas as $i => $s)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="p-4 text-sm text-gray-700">{{ $siswas->firstItem() + $i }}</td>
                                <td class="p-4 text-sm font-medium text-gray-900">{{ $s->nisn }}</td>
                                <td class="p-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $s->nama_lengkap }}</div>
                                </td>
                                <td class="p-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-50 text-blue-700">
                                        {{ $s->kelas->nama_kelas ?? '-' }}
                                    </span>
                                </td>
                                <td class="p-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-50 text-green-700">
                                        {{ $s->jurusan->nama_jurusan ?? '-' }}
                                    </span>
                                </td>
                                <td class="p-4 text-sm text-gray-700">{{ $s->tahunAjar->nama_tahun_ajar ?? '-' }}</td>
                                <td class="p-4">
                                    <a href="{{ route('siswa.show', $s->id) }}"
                                        class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800 transition">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-8 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-400">
                                        <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <p class="text-lg font-medium text-gray-500 mb-1">Tidak ada data ditemukan</p>
                                        <p class="text-sm text-gray-400">Coba gunakan filter yang berbeda</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($siswas->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $siswas->links() }}
                </div>
            @endif
        </div>

    </div>

</x-app-layout>