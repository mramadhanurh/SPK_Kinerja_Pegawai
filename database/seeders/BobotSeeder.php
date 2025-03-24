<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bobot;

class BobotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['nama_bobot' => 'Sangat baik dan sesuai', 'nilai' => 5],
            ['nama_bobot' => 'Baik dan sesuai', 'nilai' => 4],
            ['nama_bobot' => 'Cukup baik dan sesuai', 'nilai' => 3],
        ];

        Bobot::insert($data);
    }
}
