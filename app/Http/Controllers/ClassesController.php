<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource. Admin Only
     */
    public function index()
    {
        $data = Classes::with('classesToUser')->orderBy('id', 'asc')->get();
        return response()->json([
            'status' => true,
            'message' => 'Classes data retrieved successfully',
            'data' => $data
        ], 200);
    }

    /**
     * Display a listing of the resource, by User ID from User Table
     */

    public function indexTeacher(string $user_id) {
        $data = Classes::where('user_teacher_id', $user_id)->orderBy('name', 'asc')->get();
        return response()->json([
            'status' => true,
            'message' => 'Specific Classes By Teacher Id retrieved successfully',
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
            'desc' => 'required|string',
            'user_teacher_id' => 'required|integer'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => "Failed to save Class data",
                'errors' => $validator->errors(),
            ], 400);
        }

        $newData = Classes::create([
            'name' => $request->name,
            'desc' => $request->desc,
            'user_teacher_id' => $request->user_teacher_id
        ]);

        return response()->json([
            'status' => true,
            'message' => 'A class data saved successfully',
            'data' => $newData
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Classes::with('classesToUser')->find($id);
        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'A class data not found',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'A class data retrieved successfully',
            'data' => $data
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $newData = Classes::find($id);

        if (!$newData) {
            return response()->json([
                'status' => false,
                'message' => 'A class data not found',
            ], 404);
        }

        // Validate the request...
        $rules = [
            'name' => 'required|string',
            'desc' => 'required|string',
            'user_teacher_id' => 'required|integer'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => "Failed to update class data",
                'errors' => $validator->errors(),
            ], 400);
        }

        $newData->name = $request->name;
        $newData->desc = $request->desc;
        $newData->user_teacher_id = $request->user_teacher_id;
        $newData->save();

        return response()->json([
            'status' => true,
            'message' => 'A class data updated successfully',
            'data' => $newData
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Classes::find($id);
        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'A class data not found',
            ], 404);
        }

        $data->delete();
        return response()->json([
            'status' => true,
            'message' => 'A class data deleted successfully',
        ], 200);
    }
}
