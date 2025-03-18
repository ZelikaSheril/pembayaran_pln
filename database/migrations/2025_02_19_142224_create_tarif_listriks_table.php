<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tarif_listriks', function (Blueprint $table) {
            $table->id();
            $table->string('golongan');
            $table->integer('daya');
            $table->decimal('tarif_per_kwh', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tarif_listriks');
    }
};

