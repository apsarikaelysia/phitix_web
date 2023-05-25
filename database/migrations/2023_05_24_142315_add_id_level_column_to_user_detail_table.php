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
        Schema::table('user_detail', function (Blueprint $table) {
            $table->unsignedBigInteger('id_level')->after('user_fullname')->default(2);
            $table->foreign('id_level')->references('id')->on('level_detail')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_detail', function (Blueprint $table) {
            $table->dropForeign(['id_level']);
            $table->dropColumn('id_level');
        });
    }
};