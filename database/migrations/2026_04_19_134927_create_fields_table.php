<?php 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fields', function (Blueprint $table) {
            $table->id();
            $table->string('name');             // Nama lapangan (misal: Lapangan A)
            $table->string('type');             // Jenis (misal: Sintetis, Vinyl, Beton)
            $table->integer('price_per_hour');  // Harga sewa per jam
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fields');
    }
};