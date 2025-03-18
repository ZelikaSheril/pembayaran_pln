<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\DataPelanggan;
use App\Models\DaftarTagihan;
use App\Models\TarifListrik;
use Carbon\Carbon;

class GenerateTagihan extends Command
{
    protected $signature = 'generate:tagihan';
    protected $description = 'Generate tagihan listrik untuk semua pelanggan setiap bulan';

    public function handle()
{
    // Ambil semua pelanggan dengan jenis_meteran pascabayar
    $pelanggan = DataPelanggan::where('jenis_meteran', 'pascabayar')->get(); // Ubah dari tipe_pembayaran ke jenis_meteran

    $bulanSekarang = Carbon::now()->format('Y-m-01'); // Format: 2024-03-01

    foreach ($pelanggan as $p) {
        // Ambil tarif berdasarkan daya pelanggan dari tabel TarifListrik
        $tarif = TarifListrik::where('daya', $p->daya)->first();

        if (!$tarif) {
            $this->error("Tarif listrik untuk daya {$p->daya} tidak ditemukan!");
            continue;
        }

        // Simulasi pemakaian
        $pemakaian_kwh = rand(100, 500);
        $tarif_per_kwh = $tarif->tarif_per_kwh;
        $total_tagihan = ($pemakaian_kwh * $tarif_per_kwh) + 5000; // Tambah biaya admin

        // Gunakan firstOrCreate agar tidak terjadi duplikasi data
        DaftarTagihan::firstOrCreate(
            [
                'idpel' => $p->idpel,
                'bulan_tagihan' => $bulanSekarang,
            ],
            [
                'nomor_meter' => $p->nomor_meter,
                'pemakaian_kwh' => $pemakaian_kwh,
                'tarif_per_kwh' => $tarif_per_kwh,
                'total_tagihan' => $total_tagihan,
                'status_pembayaran' => 'Belum',
            ]
        );
    }

    $this->info('Tagihan listrik berhasil dibuat untuk pelanggan pascabayar.');
}

}
