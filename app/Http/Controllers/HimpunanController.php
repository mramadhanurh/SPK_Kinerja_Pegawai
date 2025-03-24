<?php

namespace App\Http\Controllers;

use App\Models\Himpunan;
use Illuminate\Http\Request;
use App\Models\Kriteria;

class HimpunanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $himpunans = Himpunan::with('kriteria')->get();
        return view('himpunan.index', compact('himpunans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kriterias = Kriteria::all();
        return view('himpunan.create', compact('kriterias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_kriteria' => 'required',
            'nama' => 'required|string|max:255',
            'nilai' => 'required|numeric',
        ]);

        Himpunan::create($request->all());

        return redirect()->route('himpunan.index')->with('success', 'Himpunan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Himpunan  $himpunan
     * @return \Illuminate\Http\Response
     */
    public function show(Himpunan $himpunan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Himpunan  $himpunan
     * @return \Illuminate\Http\Response
     */
    public function edit(Himpunan $himpunan)
    {
        $kriterias = Kriteria::all();
        return view('himpunan.edit', compact('himpunan', 'kriterias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Himpunan  $himpunan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Himpunan $himpunan)
    {
        $request->validate([
            'id_kriteria' => 'required',
            'nama' => 'required|string|max:255',
            'nilai' => 'required|numeric',
        ]);

        $himpunan->update($request->all());

        return redirect()->route('himpunan.index')->with('success', 'Himpunan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Himpunan  $himpunan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Himpunan $himpunan)
    {
        $himpunan->delete();
        return redirect()->route('himpunan.index')->with('success', 'Himpunan berhasil dihapus');
    }
}
