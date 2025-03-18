<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
{
    Schema::create('daftar_tagihans', function (Blueprint $table) {
        $table->id();
        $table->string('idpel'); // Relasi ke DataPelanggan
        $table->string('nama_pelanggan'); // Tambahkan kolom ini
        $table->string('nomor_meter');
        $table->date('bulan_tagihan');
        $table->integer('pemakaian_kwh');
        $table->decimal('tarif_per_kwh', 10, 2);
        $table->decimal('total_tagihan', 15, 2);
        $table->enum('status_pembayaran', ['Belum', 'Lunas'])->default('Belum');
        $table->timestamps();

        // Foreign Key ke DataPelanggan
        $table->foreign('idpel')->references('idpel')->on('data_pelanggans')->onDelete('cascade');
    });
}


    public function down()
    {
        Schema::dropIfExists('daftar_tagihans');
    }
};
