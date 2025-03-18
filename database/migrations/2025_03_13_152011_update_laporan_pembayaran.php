<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('laporan_pembayaran', function (Blueprint $table) {
            $table->enum('jenis_pembayaran', ['PRABAYAR', 'PASCABAYAR'])->after('status_pembayaran');
            $table->unsignedBigInteger('token')->nullable()->after('jenis_pembayaran'); // Token hanya untuk prabayar
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporan_pembayaran', function (Blueprint $table) {
            $table->dropColumn(['token', 'jenis_pembayaran']);
        });
    }
};
