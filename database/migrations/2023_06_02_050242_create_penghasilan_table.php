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
        Schema::create('tb_penghasilan', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->integer('pendapatan');
            $table->integer('pengeluaran_ayam');
            $table->integer('pengeluaran_pakan');
            $table->integer('pengeluaran_gaji');
            $table->integer('pengeluaran_vaksin');
            $table->integer('penghasilan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_penghasilan');
    }
};