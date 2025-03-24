@extends('layouts.home')

@section('title', 'Laporan')

@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row">
            <div class="card">
                <h5 class="card-header">Laporan</h5>
                <div class="table-responsive text-nowrap">
                    <table id="basic-datatables" class="table table-striped table-hover">
                        <thead>
                            <tr class="text-center">
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
                                <td class="text-center">{{ $pegawai->nip }}</td>
                                <td class="text-center">{{ $pegawai->jabatan->jabatan }}</td>
                                <td class="text-center">{{ $pegawai->pangkat->pangkat }}</td>
                                <td class="text-center">
                                    <a href="{{ route('laporan.cetak', $pegawai->id) }}" class="btn btn-secondary btn-sm btn-flat" target="_blank">Unduh PDF</a>
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
<!-- Content wrapper -->

@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $("#basic-datatables").DataTable();
            
        });
    </script>
@endsection