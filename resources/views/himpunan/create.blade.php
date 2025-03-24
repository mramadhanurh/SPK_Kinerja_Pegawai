@extends('layouts.home')

@section('title', 'Data Himpunan Kriteria')

@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Tambah Himpunan</h5>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('himpunan.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Kriteria</label>
                                <select name="id_kriteria" class="form-select form-control">
                                    <option selected value="" disabled>-- Pilih Kriteria --</option>
                                    @foreach ($kriterias as $kriteria)
                                    <option value="{{ $kriteria->id }}">{{ $kriteria->nama_kriteria }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Himpunan</label>
                                <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Himpunan">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nilai</label>
                                <input type="number" step="0.01" name="nilai" class="form-control" placeholder="--">
                            </div>

                            <button type="submit" class="btn btn-primary">
                                Simpan
                            </button>
                            <a href="{{ route('himpunan.index') }}" class="btn btn-warning">
                                Kembali
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection