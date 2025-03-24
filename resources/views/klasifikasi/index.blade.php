@extends('layouts.home')

@section('title', 'Proses Klasifikasi')

@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="py-3 mb-4" style="text-align: right;"><span class="text-muted fw-light">Home /</span> Proses Klasifikasi</h5>

        <div class="row">
            <div class="card">
                <h5 class="card-header">Proses Klasifikasi</h5>
                <div class="table-responsive text-nowrap">
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Jabatan</th>
                                <th>Setting</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pegawais as $key => $pegawai)
                            <tr>
                                <td class="text-center">{{ $key+1 }}</td>
                                <td>{{ $pegawai->nama }}</td>
                                <td class="text-center">{{ $pegawai->nip }}</td>
                                <td class="text-center">{{ $pegawai->jabatan->jabatan ?? '-' }}</td>
                                <td class="text-center">
                                    <button class="btn btn-primary btn-sm" onclick="toggleForm(`{{ $pegawai->id }}`)">
                                        Edit Klasifikasi
                                    </button>
                                </td>
                            </tr>
                            <tr id="form-{{ $pegawai->id }}" style="display: none;">
                                <td colspan="5">
                                    <form action="{{ route('klasifikasi.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="pegawai" value="{{ $pegawai->id }}">
                                        <table class="table">
                                            @foreach($kriterias as $kriteria)
                                            <tr>
                                                <td>{{ $kriteria->nama_kriteria }}</td>
                                                <td>
                                                    <select name="himpunan_{{ $kriteria->id }}" class="form-control">
                                                        <option value="">Pilih</option>
                                                        @foreach($kriteria->himpunans as $himpunan)
                                                        <option value="{{ $himpunan->id }}" {{ $pegawai->klasifikasi->where('id_himpunan', $himpunan->id)->count() > 0 ? 'selected' : '' }}>
                                                            {{ $himpunan->nama }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="2">
                                                    <button type="submit" class="btn btn-success">Simpan</button>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <hr class="my-5" />
    </div>

    <!-- / Content -->

    @include('layouts.footer')

    <div class="content-backdrop fade"></div>
</div>

<script>
    function toggleForm(id) {
        let form = document.getElementById('form-' + id);
        form.style.display = (form.style.display === 'none') ? 'table-row' : 'none';
    }
</script>

@endsection