<?php

namespace App\Http\Controllers;

use App\Models\TahunAjar;
use Illuminate\Http\Request;

class TahunAjarController extends Controller
{
    public function index()
    {
        $tahunAjar = TahunAjar::all();
        return view('tahun_ajar.index', compact('tahunAjar'));
    }

    public function create()
    {
        return view('tahun_ajar.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_tahun_ajar' => 'required|string|max:50|unique:tahun_ajars,kode_tahun_ajar',
            'nama_tahun_ajar' => 'required|string|max:255',
        ]);

        TahunAjar::create($request->all());

        return redirect()->route('tahun_ajar.index')->with('success', 'Tahun ajar berhasil ditambahkan.');
    }

    public function show(TahunAjar $tahunAjar)
    {
        return view('tahun_ajar.show', compact('tahunAjar'));
    }

    public function edit(TahunAjar $tahunAjar)
    {
        return view('tahun_ajar.edit', compact('tahunAjar'));
    }

    public function update(Request $request, TahunAjar $tahunAjar)
    {
        $request->validate([
            'kode_tahun_ajar' => 'required|string|max:50|unique:tahun_ajars,kode_tahun_ajar,' . $tahunAjar->id,
            'nama_tahun_ajar' => 'required|string|max:255',
        ]);

        $tahunAjar->update($request->all());

        return redirect()->route('tahun_ajar.index')->with('success', 'Tahun ajar berhasil diupdate.');
    }

    public function destroy(TahunAjar $tahunAjar)
    {
        $tahunAjar->delete();
        return redirect()->route('tahun_ajar.index')->with('success', 'Tahun ajar berhasil dihapus.');
    }
}
