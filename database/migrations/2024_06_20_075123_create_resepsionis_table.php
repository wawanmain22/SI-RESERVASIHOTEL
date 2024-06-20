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
        Schema::create('resepsionis', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('password');
            $table->string('nama');
            $table->string('jenis_kelamin');
            $table->string('no_hp');
            $table->string('alamat');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resepsionis');
    }
};
