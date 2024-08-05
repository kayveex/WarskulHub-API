<?php

namespace App\Http\Controllers;

use App\Models\Studentofclass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class StudentofclassController extends Controller
{
    /**
     * Display a listing of the resource, admin Only.
     */
    public function index()
    {
        $data = Studentofclass::with('studentofclassToStudents', 'studentofclassToClasses')->orderBy('id', 'asc')->get();
        return response()->json([
            'status' => true,
            'message' => 'Student of Class data retrieved successfully',
            'data' => $data
        ], 200);
    }

    /**
     * Display a listing of the resource, based on class id .
     */
    public function indexByClassId(string $id) {
        $data = Studentofclass::with('studentofclassToStudents', 'studentofclassToClasses')->where('class_id', $id)->orderBy('id', 'asc')->get();
        return response()->json([
            'status' => true,
            'message' => 'Student of Class data retrieved successfully',
            'data' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validating the request
        $rules = [
            'class_id' => 'required',
            'student_id' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => "Failed to save Student of Class data",
                'errors' => $validator->errors(),
            ], 400);
        }

        $newData = Studentofclass::create([
            'class_id' => $request->class_id,
            'student_id' => $request->student_id
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Student of Class data saved successfully',
            'data' => $newData
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Studentofclass::with('studentofclassToStudents', 'studentofclassToClasses')->where('id', $id)->first();
        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Specific Student of Class data retrieved successfully',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Specific Student of Class data not found',
                'data' => null
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updateData = Studentofclass::find($id);
        if (!$updateData) {
            return response()->json([
                'status' => false,
                'message' => 'Student of Class data not found',
            ], 404);
        }

        $rules = [
            'class_id' => 'required',
            'student_id' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => "Failed to update Student of Class data",
                'errors' => $validator->errors(),
            ], 400);
        }

        $updateData->class_id = $request->class_id;
        $updateData->student_id = $request->student_id;
        $updateData->save();

        return response()->json([
            'status' => true,
            'message' => 'Student of Class data updated successfully',
            'data' => $updateData
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Studentofclass::find($id);
        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Student of Class data not found',
            ], 404);
        }
        
        $data->delete();

        return response()->json([
            'status' => true,
            'message' => 'Student of Class data deleted successfully',
        ], 200);
    }
}
