<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('laporan_pembayaran', function (Blueprint $table) {
            // Hapus foreign key terlebih dahulu
            $table->dropForeign(['user_id']);
            // Baru hapus kolom user_id
            $table->dropColumn('user_id');
        });
    }

    public function down()
    {
        Schema::table('laporan_pembayaran', function (Blueprint $table) {
            // Tambahkan kembali kolom user_id jika rollback
            $table->unsignedBigInteger('user_id')->nullable();
            // Tambahkan kembali foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};

