<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login DAN rolenya adalah admin
        if ($request->user() && $request->user()->role === 'admin') {
            return $next($request); // Lanjut ke proses hapus
        }

        // Jika bukan admin, tolak akses (Otorisasi Gagal)
        return response()->json([
            'status' => 'error',
            'message' => 'Akses ditolak! Proses delete hanya bisa dilakukan oleh Admin.'
        ], 403);
    }
}