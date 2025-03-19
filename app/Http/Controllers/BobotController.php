<?php

namespace App\Http\Controllers;

use App\Models\Bobot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BobotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bobots = Bobot::latest()->get();

        return view('bobot.index', compact('bobots'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bobot.create');
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
            'nama_bobot' => 'required|string|max:255',
            'nilai' => 'required|string|max:3',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $bobot = Bobot::create([
            'nama_bobot' => $request->nama_bobot,
            'nilai' => $request->nilai,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data created successfully!',
            'data' => $bobot
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bobot  $bobot
     * @return \Illuminate\Http\Response
     */
    public function show(Bobot $bobot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bobot  $bobot
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bobot = Bobot::findOrFail($id);

        if (!$bobot) {
            return response()->json([
                'status' => 'error',
                'message' => 'Bobot not found'
            ], 404);
        }

        return view('bobot.edit', compact('bobot'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bobot  $bobot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bobot = Bobot::findOrFail($id);

        if (!$bobot) {
            return response()->json([
                'status' => 'error',
                'message' => 'Bobot not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama_bobot' => 'required|string|max:255',
            'nilai' => 'required|string|max:3',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = [
            'nama_bobot' => $request->nama_bobot,
            'nilai' => $request->nilai,
        ];

        $bobot->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Data updated successfully!',
            'data' => $bobot
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bobot  $bobot
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bobot = Bobot::findOrFail($id);

        if (!$bobot) {
            return response()->json([
                'status' => 'error',
                'message' => 'Bobot not found'
            ], 404);
        }

        $bobot->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data deleted successfully!'
        ], 200);
    }
}
