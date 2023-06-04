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
        Schema::create('tb_detail_pengeluaran_vaksin', function (Blueprint $table) {
            $table->unsignedBigInteger('id_pengeluaran_vaksin');
            $table->foreign('id_pengeluaran_vaksin')->references('id')->on('tb_pengeluaran_vaksin')->onDelete('restrict');
            $table->unsignedBigInteger('id_vaksin');
            $table->foreign('id_vaksin')->references('id')->on('tb_vaksin')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_detail_pengeluaran_vaksin');
    }
};
