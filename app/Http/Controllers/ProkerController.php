<?php

namespace App\Http\Controllers;

use App\Models\Proker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProkerController extends Controller
{
    /**
     * Display a listing of the resource, Only Admin.
     */
    public function index()
    {
        $data = Proker::orderBy('bulan', 'asc')->get();
        return response()->json([
            'status' => true,
            'message' => 'All Prokers data retrieved successfully',
            'data' => $data
        ], 200);

    }

    /**
     * Display a listing of the resource, Teachers View.
     */

     public function indexTeacher(string $id) {
        $data = Proker::where('class_id', $id)->orderBy('bulan','asc')->get();
        return response()->json([
            'status' => true,
            'message' => 'Specific Prokers data by class ID retrieved successfully',
            'data' => $data
        ], 200);
     }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate the request...
        $rules = [
            'bulan' => 'required|string',
            'tahun' => 'required|string',
            'pertemuan' => 'required|numeric',
            'uraian_kegiatan' => 'required|string',
            'keterangan' => 'required|string',
            'class_id' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => "Failed to save Proker data",
                'errors' => $validator->errors(),
            ], 400);
        }

        $newData = Proker::create([
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'pertemuan' => $request->pertemuan,
            'uraian_kegiatan' => $request->uraian_kegiatan,
            'keterangan' => $request->keterangan,
            'class_id' => $request->class_id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Proker data saved successfully',
            'data' => $newData
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Proker::find($id);
        if(!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Proker data not found',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Proker data retrieved successfully',
            'data' => $data
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updateData = Proker::find($id);
        if(!$updateData) {
            return response()->json([
                'status' => false,
                'message' => 'Proker data not found',
            ], 404);
        }

        $rules = [
            'bulan' => 'required|string',
            'tahun' => 'required|string',
            'pertemuan' => 'required|numeric',
            'uraian_kegiatan' => 'required|string',
            'keterangan' => 'required|string',
            'class_id' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => "Failed to update Proker data",
                'errors' => $validator->errors(),
            ], 400);
        }

        $updateData->bulan = $request->bulan;
        $updateData->tahun = $request->tahun;
        $updateData->pertemuan = $request->pertemuan;
        $updateData->uraian_kegiatan = $request->uraian_kegiatan;
        $updateData->keterangan = $request->keterangan;
        $updateData->class_id = $request->class_id;
        $updateData->save();

        return response()->json([
            'status' => true,
            'message' => 'Proker data updated successfully',
            'data' => $updateData
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Proker::find($id);
        if(!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Proker data not found',
            ], 404);
        }

        $data->delete();
        return response()->json([
            'status' => true,
            'message' => 'Proker data deleted successfully',
        ], 200);
    }
}
