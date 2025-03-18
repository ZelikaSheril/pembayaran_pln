<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TarifListrik extends Model
{
    use HasFactory;

    protected $fillable = ['golongan', 'daya', 'tarif_per_kwh'];

    // Akses kode tarif otomatis: "Golongan/Daya"
    public function getKodeTarifAttribute()
    {
        return "{$this->golongan}/{$this->daya}";
    }
    
}

