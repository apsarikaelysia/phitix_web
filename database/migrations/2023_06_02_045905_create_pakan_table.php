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
        Schema::create('tb_pakan', function (Blueprint $table) {
            $table->id();
            $table->date('pembelian')->nullable();
            $table->string('jenis_pakan')->nullable();
            $table->integer('stok_pakan')->nullable();
            $table->integer('harga_kg')->nullable();
            $table->integer('total_harga')->nullable();
            $table->integer('sisa_stok_pakan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_pakan');
    }
};