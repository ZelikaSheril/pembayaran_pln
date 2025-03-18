<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarTagihan extends Model
{
    use HasFactory;

    protected $table = 'daftar_tagihans'; // Nama tabel di database

    protected $fillable = [
        'idpel',
        'nama_pelanggan', // Pastikan ini ada
        'nomor_meter',
        'bulan_tagihan',
        'pemakaian_kwh',
        'tarif_per_kwh',
        'total_tagihan',
        'status_pembayaran',
    ];

    // Relasi ke DataPelanggan
    public function pelanggan()
    {
        return $this->belongsTo(DataPelanggan::class, 'idpel', 'idpel');
    }

    public function getNamaPelangganAttribute()
{
    return $this->pelanggan ? $this->pelanggan->nama : '-';
}



protected static function boot()
{
    parent::boot();

    static::creating(function ($tagihan) {
        $pelanggan = \App\Models\DataPelanggan::where('idpel', $tagihan->idpel)->first();
        $tagihan->nama_pelanggan = $pelanggan ? $pelanggan->nama : null;
    });

    static::updating(function ($tagihan) {
        $pelanggan = \App\Models\DataPelanggan::where('idpel', $tagihan->idpel)->first();
        $tagihan->nama_pelanggan = $pelanggan ? $pelanggan->nama : null;
    });

    static::saving(function ($model) {
        $model->nama_pelanggan = DataPelanggan::where('idpel', $model->idpel)->value('nama');
    });
}


}

