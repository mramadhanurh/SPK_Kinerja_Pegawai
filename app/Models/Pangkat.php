<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pangkat extends Model
{
    use HasFactory;

    protected $fillable = [
        'pangkat',
    ];

    // Relasi ke Pegawai (Satu Pangkat dimiliki banyak Pegawai)
    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'id_pangkat');
    }
}
