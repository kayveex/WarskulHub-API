<?php

namespace App\Http\Controllers;

use App\Models\Totalscore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TotalScoreController extends Controller
{
    /**
     * Display a listing of the resource, Admin only.
     */
    public function index()
    {
        $data = Totalscore::orderBy('totalscore', 'asc')->get();
        return response()->json([
            'status' => true,
            'message' => 'Total Score data retrieved successfully',
            'data' => $data
        ], 200);
    }

    /**
     * Display a listing of the resource, based on Class ID.
     */

    public function indexByClassId(string $id) {
        $data = Totalscore::where('class_id', $id)->orderBy('totalscore', 'asc')->get();
        return response()->json([
            'status' => true,
            'message' => 'Total Score data retrieved successfully',
            'data' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate the request
        $rules = [
            'class_id' => 'required|string',
            'student_id' => 'required|string',
            'totalscore' => 'required|numeric',
            'desc_belajar' => 'required|string',
            'tahunajar_start' => 'required',
            'tahunajar_end' => 'required',
            'semester' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to save Total Score data',
                'errors' => $validator->errors(),
            ], 400);
        }

        $newData = Totalscore::create([
            'class_id' => $request->class_id,
            'student_id' => $request->student_id,
            'totalscore' => $request->totalscore,
            'desc_belajar' => $request->desc_belajar,
            'tahunajar_start' => $request->tahunajar_start,
            'tahunajar_end' => $request->tahunajar_end,
            'semester' => $request->semester,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Total Score data saved successfully',
            'data' => $newData
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Totalscore::find($id);
        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Total Score data not found',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Total Score data retrieved successfully',
            'data' => $data
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updateData = Totalscore::find($id);
        if (!$updateData) {
            return response()->json([
                'status' => false,
                'message' => 'Total Score data not found',
            ], 404);
        }

        //validate the request
        $rules = [
            'class_id' => 'required|string',
            'student_id' => 'required|string',
            'totalscore' => 'required|numeric',
            'desc_belajar' => 'required|string',
            'tahunajar_start' => 'required',
            'tahunajar_end' => 'required',
            'semester' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update Total Score data',
                'errors' => $validator->errors(),
            ], 400);
        }

        $updateData->class_id = $request->class_id;
        $updateData->student_id = $request->student_id;
        $updateData->totalscore = $request->totalscore;
        $updateData->desc_belajar = $request->desc_belajar;
        $updateData->tahunajar_start = $request->tahunajar_start;
        $updateData->tahunajar_end = $request->tahunajar_end;
        $updateData->semester = $request->semester;
        $updateData->save();

        return response()->json([
            'status' => true,
            'message' => 'Total Score data updated successfully',
            'data' => $updateData
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Totalscore::find($id);
        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Total Score data not found',
            ], 404);
        }

        $data->delete();
        return response()->json([
            'status' => true,
            'message' => 'Total Score data deleted successfully',
        ], 200);
    }
}
