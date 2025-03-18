<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporan_pembayaran', function (Blueprint $table) {
            $table->string('no_ref')->primary(); // No referensi tetap string
            $table->string('idpel')->unique();
            $table->unsignedBigInteger('id_pelanggan');
            $table->string('nama_pelanggan');
            $table->decimal('jumlah_bayar', 10, 2);
            $table->decimal('biaya_admin', 10, 2);
            $table->decimal('total_akhir', 10, 2);
            $table->enum('status_pembayaran', ['LUNAS', 'BELUM LUNAS'])->default('LUNAS');
            $table->unsignedBigInteger('token')->nullable(); // Token hanya untuk pembayaran prabayar
            $table->enum('jenis_pembayaran', ['PRABAYAR', 'PASCABAYAR'])->nullable(); // Ambil dari jenis_meteran pelanggan
            $table->timestamps();

            $table->foreign('id_pelanggan')->references('id')->on('data_pelanggans')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan_pembayaran');
    }
};
