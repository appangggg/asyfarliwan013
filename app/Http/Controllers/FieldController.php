<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Services\FieldService;
use App\Http\Requests\StoreFieldRequest;
use Illuminate\Http\Request;
use Exception;

class FieldController extends Controller
{
    protected $fieldService;

    // Inject FieldService ke Controller
    public function __construct(FieldService $fieldService)
    {
        $this->fieldService = $fieldService;
    }

    // 1. Fungsi Tampilkan Data
    public function index()
    {
        $fields = Field::all();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mengambil daftar lapangan',
            'data' => $fields
        ]);
    }

    // 2. Fungsi Tambah Data (Dilengkapi Validasi, Error Handling & Service)
    public function store(StoreFieldRequest $request)
    {
        try {
            // 1. Request Validasi (Jika gagal, otomatis return response 422 dari FormRequest)
            $validatedData = $request->validated();

            // 2. Refactor Service (Panggil proses bisnis di service)
            $newField = $this->fieldService->createNewField($validatedData);

            return response()->json([
                'status' => 'success',
                'message' => 'Data lapangan berhasil ditambahkan!',
                'data' => $newField
            ], 201);

        } catch (Exception $e) {
            // 3. Error Handling
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // 3. Fungsi Ubah Data
    public function update(Request $request, $id)
    {
        $field = Field::find($id);

        if (!$field) {
            return response()->json(['message' => 'Data lapangan tidak ditemukan'], 404);
        }

        $field->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Informasi lapangan berhasil diperbarui',
            'data' => $field
        ]);
    }

    // 4. Fungsi Hapus Data
    public function destroy($id)
    {
        $field = Field::find($id);

        if (!$field) {
            return response()->json(['message' => 'Data lapangan tidak ditemukan'], 404);
        }

        $field->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data lapangan berhasil dihapus'
        ]);
    }
}