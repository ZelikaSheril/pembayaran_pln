<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TarifListrik;

class TarifListrikSeeder extends Seeder
{
    public function run()
    {
        TarifListrik::insert([
            ['golongan' => 'R1', 'daya' => 450, 'tarif_per_kwh' => 1000],
            ['golongan' => 'R1', 'daya' => 900, 'tarif_per_kwh' => 1500],
            ['golongan' => 'R2', 'daya' => 450, 'tarif_per_kwh' => 750],
            ['golongan' => 'B1', 'daya' => 1500, 'tarif_per_kwh' => 2000],
        ]);
    }
}

