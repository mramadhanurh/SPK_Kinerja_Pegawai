<?php

namespace App\Http\Controllers;

use App\Models\Klasifikasi;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Kriteria;
use App\Models\Himpunan;

class KlasifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pegawais = Pegawai::all();
        $kriterias = Kriteria::all();
        return view('klasifikasi.index', compact('pegawais', 'kriterias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pegawaiId = $request->pegawai;

        // Hapus data klasifikasi sebelumnya untuk pegawai ini
        Klasifikasi::where('id_pegawai', $pegawaiId)->delete();

        // Simpan klasifikasi baru
        foreach ($request->except(['_token', 'pegawai']) as $key => $himpunanId) {
            if (!empty($himpunanId)) {
                Klasifikasi::create([
                    'id_pegawai' => $pegawaiId,
                    'id_himpunan' => $himpunanId,
                ]);
            }
        }

        return redirect()->route('klasifikasi.index')->with('success', 'Data klasifikasi berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Klasifikasi  $klasifikasi
     * @return \Illuminate\Http\Response
     */
    public function show(Klasifikasi $klasifikasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Klasifikasi  $klasifikasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Klasifikasi $klasifikasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Klasifikasi  $klasifikasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Klasifikasi $klasifikasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Klasifikasi  $klasifikasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Klasifikasi $klasifikasi)
    {
        //
    }
}
