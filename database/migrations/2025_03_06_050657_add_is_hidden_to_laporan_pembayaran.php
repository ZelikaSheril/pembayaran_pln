<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('laporan_pembayaran', function (Blueprint $table) {
            $table->boolean('is_hidden')->default(false); // Tambahkan kolom is_hidden
        });
    }

    public function down()
    {
        Schema::table('laporan_pembayaran', function (Blueprint $table) {
            $table->dropColumn('is_hidden');
        });
    }
};
