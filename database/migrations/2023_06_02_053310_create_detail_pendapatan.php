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
        Schema::create('tb_detail_pendapatan', function (Blueprint $table) {
            $table->unsignedBigInteger('id_pendapatan');
            $table->foreign('id_pendapatan')->references('id')->on('tb_pendapatan')->onDelete('restrict');
            $table->unsignedBigInteger('id_distribusi');
            $table->foreign('id_distribusi')->references('id')->on('tb_distribusi')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_detail_pendapatan');
    }
};
