<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('data_pelanggans', function (Blueprint $table) {
            $table->id();
            $table->string('idpel', 12)->unique();
            $table->string('nama', 100);
            $table->text('alamat');
            $table->string('no_telepon', 15);
            $table->string('email', 100)->nullable();
            $table->string('nomor_meter', 15)->unique();
            $table->integer('daya');
            $table->enum('jenis_meteran', ['Prabayar', 'Pascabayar']);
            $table->string('jenis_tarif', 10);
            $table->string('nik', 16)->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_pelanggans');
    }
};
