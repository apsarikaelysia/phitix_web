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
        Schema::create('data_ayam', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_masuk');
            $table->integer('jumlah_masuk');
            $table->integer('harga_satuan');
            $table->integer('total_harga');
            $table->integer('mati');
            $table->integer('total_ayam');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_ayam');
    }
};