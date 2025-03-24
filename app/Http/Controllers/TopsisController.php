<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Kriteria;
use App\Models\Bobot;
use App\Models\Himpunan;
use App\Models\Klasifikasi;

class TopsisController extends Controller
{
    public function index()
    {
        // Ambil semua pegawai
        $pegawais = Pegawai::all();
        $kriterias = Kriteria::all();
        $bobotKriteria = [];

        // Ambil bobot masing-masing kriteria
        foreach ($kriterias as $kriteria) {
            $bobotKriteria[] = $kriteria->bobot_kriteria;
        }

        // Matriks Keputusan Awal
        $decisionMatrix = [];
        foreach ($pegawais as $pegawai) {
            $row = [];
            foreach ($kriterias as $kriteria) {
                // Ambil nilai dari tabel klasifikasi berdasarkan pegawai dan kriteria
                $nilai = Klasifikasi::where('id_pegawai', $pegawai->id)
                            ->whereHas('himpunan', function ($query) use ($kriteria) {
                                $query->where('id_kriteria', $kriteria->id);
                            })
                            ->with('himpunan')
                            ->first()
                            ->himpunan->nilai ?? 0;
                $row[] = $nilai;
            }
            $decisionMatrix[] = $row;
        }

        // Normalisasi Matriks
        $pegawaiIds = $pegawais->pluck('id')->toArray();
        $normalizedMatrix = $this->normalizeMatrix($decisionMatrix, $pegawaiIds);

        // Normalisasi Ternormalisasi (Dikali Bobot)
        $weightedMatrix = $this->weightedMatrix($normalizedMatrix, $bobotKriteria);

        // Menentukan Solusi Ideal Positif & Negatif
        list($idealPositive, $idealNegative) = $this->calculateIdealSolutions($weightedMatrix, $kriterias);

        // Menghitung Jarak dari Solusi Ideal
        $distances = $this->calculateDistances($weightedMatrix, $idealPositive, $idealNegative);

        // Menghitung Nilai Preferensi
        $preferences = [];
        foreach ($distances as $index => $distance) {
            $preferences[$index] = $distance['d_negatif'] / ($distance['d_positif'] + $distance['d_negatif']);
        }

        // Mengurutkan hasil berdasarkan nilai preferensi
        arsort($preferences);
        $ranking = array_keys($preferences);

        return view('topsis.index', compact(
            'pegawais',
            'kriterias',
            'decisionMatrix',
            'normalizedMatrix',
            'weightedMatrix',
            'idealPositive',
            'idealNegative',
            'distances',
            'preferences',
            'ranking'
        ));
    }

    private function normalizeMatrix($matrix, $pegawaiIds)
    {
        $normalizedMatrix = [];
        $columnSquares = array_fill(0, count($matrix[0]), 0);

        // Hitung jumlah kuadrat setiap kolom
        foreach ($matrix as $row) {
            foreach ($row as $colIndex => $value) {
                $columnSquares[$colIndex] += pow($value, 2);
            }
        }

        // Normalisasi matriks dengan menyimpan ID pegawai sebagai key
        foreach ($matrix as $rowIndex => $row) {
            $pegawaiId = $pegawaiIds[$rowIndex]; // Ambil ID pegawai sesuai indeks
            $normalizedRow = [];
            
            foreach ($row as $colIndex => $value) {
                $divisor = sqrt($columnSquares[$colIndex]);
                $normalizedRow[$colIndex] = ($divisor == 0) ? 0 : $value / $divisor;
            }

            $normalizedMatrix[$pegawaiId] = $normalizedRow; // Simpan dengan ID pegawai
        }

        return $normalizedMatrix;
    }

    private function weightedMatrix($normalizedMatrix, $weights)
    {
        $weightedMatrix = [];
        foreach ($normalizedMatrix as $row) {
            $weightedRow = [];
            foreach ($row as $colIndex => $value) {
                $weightedRow[] = $value * $weights[$colIndex];
            }
            $weightedMatrix[] = $weightedRow;
        }
        return $weightedMatrix;
    }

    private function calculateIdealSolutions($weightedMatrix, $kriterias)
    {
        $idealPositive = [];
        $idealNegative = [];

        foreach (array_keys($weightedMatrix[0]) as $colIndex) {
            $columnValues = array_column($weightedMatrix, $colIndex);
            if ($kriterias[$colIndex]->atribut == 'benefit') {
                $idealPositive[$colIndex] = max($columnValues);
                $idealNegative[$colIndex] = min($columnValues);
            } else {
                $idealPositive[$colIndex] = min($columnValues);
                $idealNegative[$colIndex] = max($columnValues);
            }
        }

        return [$idealPositive, $idealNegative];
    }

    private function calculateDistances($weightedMatrix, $idealPositive, $idealNegative)
    {
        $distances = [];

        foreach ($weightedMatrix as $rowIndex => $row) {
            $d_positif = 0;
            $d_negatif = 0;

            foreach ($row as $colIndex => $value) {
                $d_positif += pow($value - $idealPositive[$colIndex], 2);
                $d_negatif += pow($value - $idealNegative[$colIndex], 2);
            }

            $distances[$rowIndex] = [
                'd_positif' => sqrt($d_positif),
                'd_negatif' => sqrt($d_negatif),
            ];
        }

        return $distances;
    }
}
