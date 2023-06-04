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
        Schema::create('tb_detail_pengeluaran_ayam', function (Blueprint $table) {
            $table->unsignedBigInteger('id_pengeluaran_ayam');
            $table->foreign('id_pengeluaran_ayam')->references('id')->on('tb_pengeluaran_ayam')->onDelete('restrict');
            $table->unsignedBigInteger('id_ayam');
            $table->foreign('id_ayam')->references('id')->on('tb_ayam')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_detail_pengeluaran_ayam');
    }
};
