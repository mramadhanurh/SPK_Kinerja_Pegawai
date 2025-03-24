<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kriteria', 'atribut', 'bobot_kriteria',
    ];

    public function himpunans()
    {
        return $this->hasMany(Himpunan::class, 'id_kriteria');
    }
}
