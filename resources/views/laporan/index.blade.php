@extends('layouts.home')

@section('title', 'Laporan')

@section('content')

<div class="container">
    <h3>Laporan</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Pegawai</th>
                <th>NIP</th>
                <th>Jabatan</th>
                <th>Pangkat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pegawais as $pegawai)
            <tr>
                <td>{{ $pegawai->nama }}</td>
                <td>{{ $pegawai->nip }}</td>
                <td>{{ $pegawai->jabatan->jabatan }}</td>
                <td>{{ $pegawai->pangkat->pangkat }}</td>
                <td>
                    <a href="{{ route('laporan.cetak', $pegawai->id) }}" class="btn btn-secondary" target="_blank">Unduh PDF</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
