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
        Schema::create('tb_ayam', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_masuk')->nullable();
            $table->integer('jumlah_masuk')->nullable();
            $table->integer('harga_satuan')->nullable();
            $table->integer('total_harga')->nullable();
            $table->integer('mati')->nullable();
            $table->integer('total_ayam')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_ayam');
    }
};