<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('laporan_pembayaran', function (Blueprint $table) {
            $table->unsignedBigInteger('dibayar_oleh')->nullable()->after('status_pembayaran');
            $table->foreign('dibayar_oleh')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('laporan_pembayaran', function (Blueprint $table) {
            $table->dropForeign(['dibayar_oleh']);
            $table->dropColumn('dibayar_oleh');
        });
    }
};

