<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Pangkat;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pegawais = Pegawai::latest()->get();

        return view('pegawai.index', compact('pegawais'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pangkats = Pangkat::all();
        $jabatans = Jabatan::all();

        return view('pegawai.create', compact('pangkats', 'jabatans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:18',
            'id_pangkat' => 'required',
            'id_jabatan' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $pegawai = Pegawai::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'id_pangkat' => $request->id_pangkat,
            'id_jabatan' => $request->id_jabatan,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data created successfully!',
            'data' => $pegawai
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pangkats = Pangkat::all();
        $jabatans = Jabatan::all();
        $pegawai = Pegawai::findOrFail($id);

        if (!$pegawai) {
            return response()->json([
                'status' => 'error',
                'message' => 'Pegawai not found'
            ], 404);
        }

        return view('pegawai.edit', compact('pegawai', 'pangkats', 'jabatans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);

        if (!$pegawai) {
            return response()->json([
                'status' => 'error',
                'message' => 'Pegawai not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:18',
            'id_pangkat' => 'required',
            'id_jabatan' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = [
            'nama' => $request->nama,
            'nip' => $request->nip,
            'id_pangkat' => $request->id_pangkat,
            'id_jabatan' => $request->id_jabatan,
        ];

        $pegawai->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Data updated successfully!',
            'data' => $pegawai
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);

        if (!$pegawai) {
            return response()->json([
                'status' => 'error',
                'message' => 'Pegawai not found'
            ], 404);
        }

        $pegawai->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data deleted successfully!'
        ], 200);
    }
}
