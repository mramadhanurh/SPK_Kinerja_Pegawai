<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;

class LaporanController extends Controller
{
    public function index()
    {
        $pegawais = Pegawai::all();
        return view('laporan.index', compact('pegawais'));
    }

    public function cetakLaporan($id)
    {
        $pegawai = Pegawai::with(['pangkat', 'jabatan', 'klasifikasi.himpunan.kriteria'])->findOrFail($id);

        return view('laporan.cetak', compact('pegawai'));
    }
}
