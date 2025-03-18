<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class LaporanPembayaran extends Model
{
    use HasFactory;

    protected $table = 'laporan_pembayaran';
    protected $primaryKey = 'no_ref'; // Gunakan no_ref sebagai primary key
    public $incrementing = false; // Nonaktifkan auto-increment
    protected $keyType = 'string'; // Primary key berupa string
    public $timestamps = true;

    protected $fillable = [
        'no_ref',
        'idpel',
        'id_pelanggan',
        'nama_pelanggan',
        'jumlah_bayar',
        'biaya_admin',
        'total_akhir',
        'status_pembayaran', 
        'dibayar_oleh',
        'nama_pembayar', 
        'is_hidden',
        'jenis_pembayaran',
        'token', 
    ];
    

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->no_ref = 'REF-' . strtoupper(Str::random(10)); // Generate no_ref otomatis
        });
    }

    public function pelanggan()
    {
        return $this->belongsTo(DataPelanggan::class, 'id_pelanggan', 'id');
    }

    public function pembayar()
    {
        return $this->belongsTo(User::class, 'dibayar_oleh');
    }

    public function tagihan()
    {
        return $this->belongsTo(DaftarTagihan::class, 'tagihan_id');
    }



}
