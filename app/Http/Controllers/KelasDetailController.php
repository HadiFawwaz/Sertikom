<?php

namespace App\Http\Controllers;

use App\Models\KelasDetail;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\TahunAjar;
use Illuminate\Http\Request;

class KelasDetailController extends Controller
{
    public function index()
    {
        $kelas_detail
            = KelasDetail::with(['siswa', 'kelas', 'tahunAjar'])->get();
        return view('kelas_detail.index', compact('kelas_detail
'));
    }

    public function create()
    {
        $siswa = Siswa::all();
        $kelas = Kelas::all();
        $tahunAjars = TahunAjar::all();
        return view('kelas_detail.create', compact('siswa', 'kelas', 'tahunAjars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'kelas_id' => 'required|exists:kelas,id',
            'tahun_ajar_id' => 'required|exists:tahun_ajars,id',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        KelasDetail::create($request->only(['siswa_id', 'kelas_id', 'tahun_ajar_id', 'status']));

        return redirect()->route('kelas-detail.index')->with('success', 'Detail kelas dibuat');
    }

    public function show(KelasDetail $kelasDetail)
    {
        return view('kelas_detail.show', ['item' => $kelasDetail]);
    }

    public function edit(KelasDetail $kelasDetail)
    {
        $siswa = Siswa::all();
        $kelas = Kelas::all();
        $tahunAjars = TahunAjar::all();
        return view('kelas_detail.edit', compact('kelasDetail', 'siswa', 'kelas', 'tahunAjars'));
    }

    public function update(Request $request, KelasDetail $kelasDetail)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'kelas_id' => 'required|exists:kelas,id',
            'tahun_ajar_id' => 'required|exists:tahun_ajars,id',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $kelasDetail->update($request->only(['siswa_id', 'kelas_id', 'tahun_ajar_id', 'status']));

        return redirect()->route('kelas-detail.index')->with('success', 'Detail kelas diperbarui');
    }

    public function destroy(KelasDetail $kelasDetail)
    {
        $kelasDetail->delete();
        return redirect()->route('kelas-detail.index')->with('success', 'Detail kelas dihapus');
    }
}
