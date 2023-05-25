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
        Schema::table('catat_ayam', function (Blueprint $table) {
            $table->unsignedBigInteger('id_ayam')->after('id')->default(2);
            $table->foreign('id_ayam')->references('id')->on('data_ayam')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('catat_ayam', function (Blueprint $table) {
            $table->dropForeign(['id_ayam']);
            $table->dropColumn('id_ayam');
        });
    }
};