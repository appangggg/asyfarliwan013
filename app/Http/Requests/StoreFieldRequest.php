<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFieldRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'type' => 'required|string|max:50',
            'price_per_hour' => 'required|integer|min:10000', // Minimal harga 10.000
        ];
    }
    
    // Pesan error kustom (Opsional)
    public function messages(): array
    {
        return [
            'name.required' => 'Nama lapangan wajib diisi.',
            'price_per_hour.min' => 'Harga sewa per jam minimal Rp 10.000.',
        ];
    }
}