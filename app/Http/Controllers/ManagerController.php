<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use App\Models\Himpunan;
use App\Models\Jabatan;
use App\Models\Kriteria;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    
    public function index()
    {
        $pegawais = Pegawai::count();
        $jabatans = Jabatan::count();
        $kriterias = Kriteria::count();
        $himpunans = Himpunan::count();

        return view('manager', compact('pegawais', 'jabatans', 'kriterias', 'himpunans'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
