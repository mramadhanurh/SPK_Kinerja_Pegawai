<?php

namespace App\Http\Controllers;

use App\Models\Pangkat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PangkatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pangkats = Pangkat::latest()->get();

        return view('pangkat.index', compact('pangkats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pangkat.create');
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
            'pangkat' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $pangkat = Pangkat::create([
            'pangkat' => $request->pangkat,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data created successfully!',
            'data' => $pangkat
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pangkat  $pangkat
     * @return \Illuminate\Http\Response
     */
    public function show(Pangkat $pangkat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pangkat  $pangkat
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pangkat = Pangkat::findOrFail($id);

        if (!$pangkat) {
            return response()->json([
                'status' => 'error',
                'message' => 'Pangkat not found'
            ], 404);
        }

        return view('pangkat.edit', compact('pangkat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pangkat  $pangkat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pangkat = Pangkat::findOrFail($id);

        if (!$pangkat) {
            return response()->json([
                'status' => 'error',
                'message' => 'Pangkat not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'pangkat' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = [
            'pangkat' => $request->pangkat,
        ];

        $pangkat->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Data updated successfully!',
            'data' => $pangkat
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pangkat  $pangkat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pangkat = Pangkat::findOrFail($id);

        if (!$pangkat) {
            return response()->json([
                'status' => 'error',
                'message' => 'Pangkat not found'
            ], 404);
        }

        $pangkat->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data deleted successfully!'
        ], 200);
    }
}
