<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'nip', 'id_pangkat', 'id_jabatan',
    ];

    // Relasi ke Pangkat (Satu Pangkat dimiliki banyak Pegawai)
    public function pangkat()
    {
        return $this->belongsTo(Pangkat::class, 'id_pangkat');
    }

    // Relasi ke Jabatan (Satu Jabatan dimiliki banyak Pegawai)
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan');
    }
}
