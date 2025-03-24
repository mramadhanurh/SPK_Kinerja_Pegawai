<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Himpunan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_kriteria', 'nama', 'nilai',
    ];

    // Relasi ke Kriteria
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria');
    }

    // Relasi ke Klasifikasi
    public function klasifikasi()
    {
        return $this->hasMany(Klasifikasi::class, 'id_himpunan');
    }
}
