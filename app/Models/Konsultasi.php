<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
    use HasFactory;

    protected $table = 'konsultasis'; // Sesuaikan dengan nama tabel di database

    protected $fillable = [
        'nama',
        'email',
        'pesan',
    ];
}
