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
        Schema::create('reservasi_kamars', function (Blueprint $table) {
            $table->foreignId('id_reservasi')->constrained('reservasis')->onDelete('cascade');
            $table->foreignId('id_kamar')->constrained('kamars')->onDelete('cascade');
            $table->timestamps();
            $table->primary(['id_reservasi', 'id_kamar']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasi_kamars');
    }
};
