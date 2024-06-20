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
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_resepsionis')->constrained('resepsionis');
            $table->foreignId('id_pelanggan')->constrained('pelanggans');
            $table->enum('status', ['Booked', 'Checkin', 'Checkout'])->default('Booked');
            $table->date('tgl_checkin');
            $table->date('tgl_checkout');
            $table->timestamp('waktu_pemesanan')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasis');
    }
};
