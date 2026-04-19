<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    // Field yang diizinkan untuk diisi saat proses create/update
    protected $fillable = [
        'name', 
        'type', 
        'price_per_hour'
    ];
}