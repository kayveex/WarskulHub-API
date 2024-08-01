<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource, Admin Only.
     */
    public function index()
    {
        $data = Students::orderBy('name', 'asc')->get();
        return response()->json([
            'status' => true,
            'message' => 'Students data retrieved successfully',
            'data' => $data
        ], 200);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request...
        $rules = [
            'name' => 'required|string',
            'nis' => 'required|string',
            'gender' => 'required|string',
            'kelas' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => "Failed to save Student data",
                'errors' => $validator->errors(),
            ], 400);
        }

        $newData = Students::create([
            'name' => $request->name,
            'nis' => $request->nis,
            'gender' => $request->gender,
            'kelas' => $request->kelas,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Student data saved successfully',
            'data' => $newData
        ], 201);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Students::find($id);
        if(!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Student data not found',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Student data retrieved successfully',
            'data' => $data
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updateData = Students::find($id);
        if(!$updateData) {
            return response()->json([
                'status' => false,
                'message' => 'Student data not found',
            ], 404);
        }

        // Validate the request...
        $rules = [
            'name' => 'required|string',
            'nis' => 'required|string',
            'gender' => 'required|string',
            'kelas' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => "Failed to update Student data",
                'errors' => $validator->errors(),
            ], 400);
        }

        $updateData->name = $request->name;
        $updateData->nis = $request->nis;
        $updateData->gender = $request->gender;
        $updateData->kelas = $request->kelas;
        $updateData->save();

        return response()->json([
            'status' => true,
            'message' => 'Student data updated successfully',
            'data' => $updateData
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Students::find($id);
        if(!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Student data not found',
            ], 404);
        }

        $data->delete();
        return response()->json([
            'status' => true,
            'message' => 'Student data deleted successfully',
        ], 200);
    }
}
