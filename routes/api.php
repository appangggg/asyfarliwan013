<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FieldController;
use App\Http\Middleware\IsAdmin;

// Route Terbuka (Tidak perlu login)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Route Tertutup (Harus Login / Autentikasi)
Route::middleware('auth:sanctum')->group(function () {
    
    // Semua user yang login (Admin & User) bisa mengakses ini
    Route::get('/fields', [FieldController::class, 'index']);
    Route::post('/fields', [FieldController::class, 'store']);
    Route::put('/fields/{id}', [FieldController::class, 'update']);
    
    // Otorisasi Khusus: Hanya Admin yang bisa mengakses route Delete
    Route::delete('/fields/{id}', [FieldController::class, 'destroy'])
        ->middleware(IsAdmin::class); 
});