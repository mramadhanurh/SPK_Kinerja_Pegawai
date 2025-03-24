<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kriteria;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['nama_kriteria' => 'Berorientasi pelayanan', 'atribut' => 'benefit', 'bobot_kriteria' => 2],
            ['nama_kriteria' => 'Akuntabel', 'atribut' => 'benefit', 'bobot_kriteria' => 3],
            ['nama_kriteria' => 'Kompeten', 'atribut' => 'benefit', 'bobot_kriteria' => 4],
            ['nama_kriteria' => 'Harmonis', 'atribut' => 'benefit', 'bobot_kriteria' => 5],
            ['nama_kriteria' => 'Loyalitas', 'atribut' => 'benefit', 'bobot_kriteria' => 5],
            ['nama_kriteria' => 'Keterampilan', 'atribut' => 'benefit', 'bobot_kriteria' => 3],
            ['nama_kriteria' => 'Disiplin', 'atribut' => 'benefit', 'bobot_kriteria' => 4],
            ['nama_kriteria' => 'Komunikasi', 'atribut' => 'benefit', 'bobot_kriteria' => 4],
        ];

        Kriteria::insert($data);
    }
}
