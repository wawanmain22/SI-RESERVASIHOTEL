<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservasi_pelanggans', function (Blueprint $table) {
            $table->foreignId('id_reservasi_pelanggan')->constrained('reservasis')->onDelete('cascade');
            $table->foreignId('id_pelanggan')->constrained('pelanggans')->onDelete('cascade');
            $table->timestamps();
            $table->primary(['id_reservasi_pelanggan', 'id_pelanggan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasi_pelanggans');
    }
};
