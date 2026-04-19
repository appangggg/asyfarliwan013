<?php 
namespace App\Services;

use App\Models\Field;
use Illuminate\Support\Facades\Log;
use Exception;

class FieldService
{
    /**
     * Logika untuk menyimpan data lapangan baru
     */
    public function createNewField(array $data)
    {
        try {
            // Proses simpan data lapangan ke database
            $field = Field::create($data);
            
            return $field;

        } catch (Exception $e) {
            // Catat error ke file log Laravel agar mudah di-debug
            Log::error('Gagal menyimpan lapangan: ' . $e->getMessage());
            
            // Lemparkan error ke Controller
            throw new Exception("Terjadi kesalahan saat menyimpan data lapangan. Silakan coba lagi.");
        }
    }
}