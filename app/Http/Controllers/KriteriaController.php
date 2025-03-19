<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kriterias = Kriteria::latest()->get();

        return view('kriteria.index', compact('kriterias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kriteria.create');
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
            'nama_kriteria' => 'required|string|max:255',
            'atribut' => 'required',
            'bobot_kriteria' => 'nullable|string|max:3',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $kriteria = Kriteria::create([
            'nama_kriteria' => $request->nama_kriteria,
            'atribut' => $request->atribut,
            'bobot_kriteria' => $request->bobot_kriteria,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data created successfully!',
            'data' => $kriteria
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function show(Kriteria $kriteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kriteria = Kriteria::findOrFail($id);

        if (!$kriteria) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kriteria not found'
            ], 404);
        }

        return view('kriteria.edit', compact('kriteria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kriteria = Kriteria::findOrFail($id);

        if (!$kriteria) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kriteria not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama_kriteria' => 'required|string|max:255',
            'atribut' => 'required',
            'bobot_kriteria' => 'nullable|string|max:3',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = [
            'nama_kriteria' => $request->nama_kriteria,
            'atribut' => $request->atribut,
            'bobot_kriteria' => $request->bobot_kriteria,
        ];

        $kriteria->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Data updated successfully!',
            'data' => $kriteria
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kriteria = Kriteria::findOrFail($id);

        if (!$kriteria) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kriteria not found'
            ], 404);
        }

        $kriteria->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data deleted successfully!'
        ], 200);
    }
}
