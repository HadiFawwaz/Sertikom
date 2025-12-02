<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Detail Siswa</h2>
                <p class="text-sm text-gray-600 mt-1">Informasi lengkap dan riwayat kelas</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('siswa.edit', $siswa->id) }}"
                   class="px-4 py-2 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition text-sm font-medium">
                    Edit Data
                </a>
                <a href="{{ route('siswa.index') }}" 
                   class="text-sm font-medium text-gray-600 hover:text-gray-900">
                    ← Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto">
            {{-- Notifikasi --}}
            @if (session('success'))
                <div x-data="{ show: true }" 
                     x-show="show"
                     x-transition.opacity.duration.500ms
                     x-init="setTimeout(() => show = false, 3000)"
                     class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-green-800 font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Informasi Siswa --}}
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-gray-200 bg-gray-50">
                            <h3 class="text-lg font-semibold text-gray-900">Informasi Siswa</h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-4">
                                    <div>
                                        <label class="text-sm font-medium text-gray-500">NISN</label>
                                        <p class="mt-1 text-lg font-semibold text-gray-900">{{ $siswa->nisn }}</p>
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-gray-500">Nama Lengkap</label>
                                        <p class="mt-1 text-lg font-semibold text-gray-900">{{ $siswa->nama_lengkap }}</p>
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-gray-500">Jenis Kelamin</label>
                                        <p class="mt-1">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                                {{ $siswa->jenis_kelamin == 'laki-laki' ? 'bg-blue-50 text-blue-700' : 'bg-pink-50 text-pink-700' }}">
                                                {{ $siswa->jenis_kelamin }}
                                            </span>
                                        </p>
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-gray-500">Tanggal Lahir</label>
                                        <p class="mt-1 text-gray-900">{{ $siswa->tanggal_lahir->format('d F Y') }}</p>
                                    </div>
                                </div>
                                <div class="space-y-4">
                                    <div>
                                        <label class="text-sm font-medium text-gray-500">Jurusan</label>
                                        <p class="mt-1">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-50 text-green-700">
                                                {{ $siswa->jurusan->nama_jurusan }}
                                            </span>
                                        </p>
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-gray-500">Kelas</label>
                                        <p class="mt-1">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-50 text-blue-700">
                                                {{ $siswa->kelas->nama_kelas }}
                                            </span>
                                        </p>
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-gray-500">Tahun Ajar</label>
                                        <p class="mt-1">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-50 text-purple-700">
                                                {{ $siswa->tahunAjar->nama_tahun_ajar }}
                                            </span>
                                        </p>
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-gray-500">Usia</label>
                                        <p class="mt-1 text-gray-900">
                                            {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->age }} tahun
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <label class="text-sm font-medium text-gray-500">Alamat</label>
                                <p class="mt-2 text-gray-900">{{ $siswa->alamat }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Form Update Kelas --}}
                    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden mt-6">
                        <div class="p-6 border-b border-gray-200 bg-gray-50">
                            <h3 class="text-lg font-semibold text-gray-900">Update Kelas Siswa</h3>
                        </div>
                        <form action="{{ route('siswa.update', $siswa->id) }}" method="POST" class="p-6">
                            @csrf
                            @method('PUT')
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Kelas Baru</label>
                                    <select name="kelas_id" 
                                            class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                        @foreach($kelas as $k)
                                            <option value="{{ $k->id }}" {{ $siswa->kelas_id == $k->id ? 'selected' : '' }}>
                                                {{ $k->nama_kelas }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Tahun Ajar</label>
                                    <select name="tahun_ajar_id" 
                                            class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                        @foreach($tahunAjar as $t)
                                            <option value="{{ $t->id }}" {{ $siswa->tahun_ajar_id == $t->id ? 'selected' : '' }}>
                                                {{ $t->nama_tahun_ajar }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Jurusan</label>
                                    <select name="jurusan_id" 
                                            class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                        @foreach($jurusan as $j)
                                            <option value="{{ $j->id }}" {{ $siswa->jurusan_id == $j->id ? 'selected' : '' }}>
                                                {{ $j->nama_jurusan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <button type="submit" 
                                    class="mt-6 w-full md:w-auto px-6 py-3 bg-gray-900 text-white rounded-xl hover:bg-gray-800 transition font-medium">
                                Update Kelas
                            </button>
                            
                        </form>
                    </div>
                </div>

                {{-- Riwayat Kelas --}}
                <div>
                    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-gray-200 bg-gray-50">
                            <h3 class="text-lg font-semibold text-gray-900">Riwayat Kelas</h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                @foreach($riwayat as $r)
                                    <div class="p-4 border border-gray-200 rounded-xl hover:border-gray-300 transition">
                                        <div class="flex justify-between items-start mb-2">
                                            <span class="font-medium text-gray-900">{{ $r->kelas->nama_kelas }}</span>
                                            <span class="px-2 py-1 text-xs font-medium rounded-full 
                                                {{ $r->status == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                                {{ $r->status }}
                                            </span>
                                        </div>  
                                        <div class="text-sm text-gray-600">
                                            {{ $r->tahunAjar->nama_tahun_ajar }}
                                        </div>
                                        @if($r->created_at)
                                            <div class="text-xs text-gray-500 mt-2">
                                                Diupdate: {{ $r->created_at->format('d M Y') }}
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>