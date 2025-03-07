<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jabatans = Jabatan::latest()->get();

        return view('jabatan.index', compact('jabatans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jabatan.create');
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
            'jabatan' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $jabatan = Jabatan::create([
            'jabatan' => $request->jabatan,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data created successfully!',
            'data' => $jabatan
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function show(Jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jabatan = Jabatan::findOrFail($id);

        if (!$jabatan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Jabatan not found'
            ], 404);
        }

        return view('jabatan.edit', compact('jabatan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $jabatan = Jabatan::findOrFail($id);

        if (!$jabatan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Jabatan not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'jabatan' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = [
            'jabatan' => $request->jabatan,
        ];

        $jabatan->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Data updated successfully!',
            'data' => $jabatan
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jabatan = Jabatan::findOrFail($id);

        if (!$jabatan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Jabatan not found'
            ], 404);
        }

        $jabatan->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data deleted successfully!'
        ], 200);
    }
}
