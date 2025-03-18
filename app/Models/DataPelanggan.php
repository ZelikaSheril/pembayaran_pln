<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPelanggan extends Model
{
    use HasFactory;

    protected $table = 'data_pelanggans'; // Nama tabel di database

    protected $primaryKey = 'idpel'; // ID Pelanggan sebagai Primary Key
    public $incrementing = false; // Karena ID pelanggan tidak auto-increment
    protected $keyType = 'string'; // ID pelanggan menggunakan string

    protected $fillable = [
        'idpel',
        'nama',
        'alamat',
        'no_telepon',
        'email',
        'nomor_meter',
        'daya',
        'jenis_meteran',
        'jenis_tarif',
        'nik',
    ];

    public function tagihan()
{
    return $this->hasMany(DaftarTagihan::class, 'idpel', 'idpel');
}

public function pelanggan()
{
    return $this->belongsTo(DataPelanggan::class, 'idpel', 'idpel');
}


}
