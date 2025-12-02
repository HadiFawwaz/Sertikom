<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // cards totals
        $totalSiswa   = Siswa::count();
        $totalKelas   = Kelas::count();
        $totalJurusan = Jurusan::count();
        $totalLainnya = 0; // ganti kalau mau item lain

        // filters
        $kelasId   = $request->input('kelas_id');
        $jurusanId = $request->input('jurusan_id');
        $search    = $request->input('search');

        // query siswa with filters (eager load relations)
        $siswasQuery = Siswa::with(['kelas', 'jurusan', 'tahunAjar']);

        if ($kelasId) {
            $siswasQuery->where('kelas_id', $kelasId);
        }

        if ($jurusanId) {
            $siswasQuery->where('jurusan_id', $jurusanId);
        }

        if ($search) {
            $siswasQuery->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('nisn', 'like', "%{$search}%");
            });
        }

        $siswas = $siswasQuery->orderBy('nama_lengkap')->paginate(10)->withQueryString();

        // data for filter selects
        $kelasList   = Kelas::orderBy('nama_kelas')->get();
        $jurusanList = Jurusan::orderBy('nama_jurusan')->get();

        return view('dashboard', compact(
            'totalSiswa',
            'totalKelas',
            'totalJurusan',
            'totalLainnya',
            'siswas',
            'kelasList',
            'jurusanList',
            'kelasId',
            'jurusanId',
            'search'
        ));
    }
}
