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
        Schema::create('tb_vaksin', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_ovk')->nullable();
            $table->string('jenis_ovk')->nullable();
            $table->date('next_ovk')->nullable();
            $table->integer('jumlah_ayam')->nullable();
            $table->integer('biaya_ovk')->nullable();
            $table->integer('total_biaya')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_vaksin');
    }
};
