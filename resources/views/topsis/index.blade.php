@extends('layouts.home')

@section('title', 'Analisa Topsis')

@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="card">
                <h3 class="card-header">Proses Perhitungan Metode TOPSIS</h3>

                <h3>Matriks Keputusan Awal</h3>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr class="text-center">
                                <th>Pegawai</th>
                                @foreach($kriterias as $kriteria)
                                <th>{{ $kriteria->nama_kriteria }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach($pegawais as $index => $pegawai)
                            <tr>
                                <td>{{ $pegawai->nama }}</td>
                                @foreach($decisionMatrix[$index] as $value)
                                <td class="text-center">{{ $value }}</td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <br><br>
                <h3>Matriks Normalisasi</h3>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Pegawai</th>
                                @foreach ($kriterias as $kriteria)
                                <th>{{ $kriteria->nama_kriteria }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($normalizedMatrix as $pegawaiId => $row)
                                @php
                                    $pegawai = $pegawais->find($pegawaiId); // Ambil data pegawai
                                @endphp
                            <tr>
                                <td>{{ $pegawai ? $pegawai->nama : 'Tidak Diketahui' }}</td> <!-- Nama Pegawai -->
                                @foreach ($row as $value)
                                <td class="text-center">{{ number_format($value, 4) }}</td> <!-- Nilai Normalisasi -->
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <br><br>
                <h3>Solusi Ideal Positif</h3>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Kriteria</th>
                                <th>Nilai Ideal Positif</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($idealPositive as $index => $value)
                                <tr>
                                    <td>{{ $kriterias[$index]->nama_kriteria ?? 'Kriteria Tidak Diketahui' }}</td>
                                    <td>{{ number_format($value, 4) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <br><br>
                <h3>Solusi Ideal Negatif</h3>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Kriteria</th>
                                <th>Nilai Ideal Negatif</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($idealNegative as $index => $value)
                                <tr>
                                    <td>{{ $kriterias[$index]->nama_kriteria ?? 'Kriteria Tidak Diketahui' }}</td>
                                    <td>{{ number_format($value, 4) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <br><br>
                <h3>Jarak Solusi</h3>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr class="text-center">
                                <th>Pegawai</th>
                                <th>D+</th>
                                <th>D-</th>
                                <th>Nilai Preferensi</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach($preferences as $index => $value)
                            <tr>
                                <td>{{ $pegawais[$index]->nama }}</td>
                                <td class="text-center">{{ number_format($distances[$index]['d_positif'], 4) }}</td>
                                <td class="text-center">{{ number_format($distances[$index]['d_negatif'], 4) }}</td>
                                <td class="text-center">{{ number_format($value, 4) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection