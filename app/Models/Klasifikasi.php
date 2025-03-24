<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klasifikasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pegawai', 'id_himpunan',
    ];

    // Relasi ke Pegawai
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }

    // Relasi ke Himpunan
    public function himpunan()
    {
        return $this->belongsTo(Himpunan::class, 'id_himpunan');
    }
}
