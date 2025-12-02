<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\TahunAjar;
use App\Models\KelasDetail;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $siswas = Siswa::with(['jurusan', 'kelas', 'tahunAjar'])
            ->when($search, function ($query) use ($search) {
                $query->where('nama_lengkap', 'like', "%$search%")
                    ->orWhere('nisn', 'like', "%$search%");
            })
            ->orderBy('nama_lengkap')
            ->paginate(10);

        return view('siswa.index', compact('siswas', 'search'));
    }

    public function create()
    {
        return view('siswa.create', [
            'jurusans' => Jurusan::all(),
            'kelas' => Kelas::all(),
            'tahunAjar' => TahunAjar::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|unique:siswas,nisn',
            'nama_lengkap' => 'required|string',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
            'jurusan_id' => 'required|exists:jurusans,id',
            'kelas_id' => 'required|exists:kelas,id',
            'tahun_ajar_id' => 'required|exists:tahun_ajars,id',
        ]);

        $siswa = Siswa::create($request->all());

        KelasDetail::create([
            'siswa_id' => $siswa->id,
            'kelas_id' => $request->kelas_id,
            'tahun_ajar_id' => $request->tahun_ajar_id,
            'status' => 'aktif',
        ]);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function show(Siswa $siswa)
    {
        $riwayat = KelasDetail::with(['kelas', 'tahunAjar'])
            ->where('siswa_id', $siswa->id)
            ->orderBy('tahun_ajar_id')
            ->get();

        // data untuk dropdown
        $jurusan = Jurusan::all();
        $kelas = Kelas::all();
        $tahunAjar = TahunAjar::all();

        $kelas = Kelas::all();
        $tahunAjar = TahunAjar::all();
        $jurusan = Jurusan::all();

        return view('siswa.show', compact('siswa', 'riwayat', 'kelas', 'tahunAjar', 'jurusan'));
    }


    public function edit(Siswa $siswa)
    {
        return view('siswa.edit', [
            'siswa' => $siswa,
            'jurusans' => Jurusan::all(),
            'kelas' => Kelas::all(),
            'tahunAjar' => TahunAjar::all(),
        ]);
    }

    public function update(Request $request, Siswa $siswa)
    {
        // VALIDASI LENGKAP
        $request->validate([
            'nisn' => 'required|unique:siswas,nisn,' . $siswa->id,
            'nama_lengkap' => 'required|string',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
            'jurusan_id' => 'required|exists:jurusans,id',
            'kelas_id' => 'required|exists:kelas,id',
            'tahun_ajar_id' => 'required|exists:tahun_ajars,id',
        ]);

        // CEK APAKAH KELAS / TAHUN / JURUSAN BERUBAH
        $isKelasChanged =
            $request->kelas_id != $siswa->kelas_id ||
            $request->tahun_ajar_id != $siswa->tahun_ajar_id ||
            $request->jurusan_id != $siswa->jurusan_id;

        // UPDATE SEMUA DATA SISWA (INI YANG SEBELUMNYA TIDAK ADA!)
        $siswa->update([
            'nisn' => $request->nisn,
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'jurusan_id' => $request->jurusan_id,
            'kelas_id' => $request->kelas_id,
            'tahun_ajar_id' => $request->tahun_ajar_id,
        ]);

        // KALAU GANTI KELAS / TAHUN AJAR
        if ($isKelasChanged) {

            // nonaktifkan riwayat aktif sebelumnya
            KelasDetail::where('siswa_id', $siswa->id)
                ->where('status', 'aktif')
                ->update(['status' => 'nonaktif']);

            // tambah riwayat baru
            KelasDetail::create([
                'siswa_id' => $siswa->id,
                'kelas_id' => $request->kelas_id,
                'tahun_ajar_id' => $request->tahun_ajar_id,
                'status' => 'aktif',
            ]);
        }

        return redirect()
            ->route('siswa.show', $siswa->id)
            ->with('success', 'Data siswa berhasil diperbarui.');
    }



    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}
