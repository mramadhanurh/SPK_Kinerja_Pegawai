@extends('layouts.home')

@section('title', 'Data Himpunan Kriteria')

@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="py-3 mb-4" style="text-align: right;"><span class="text-muted fw-light">Home /</span> Data Himpunan Kriteria</h5>

        <div class="row">
            <div class="card">
                <h5 class="card-header">Data Himpunan Kriteria</h5>
                <div class="table-responsive text-nowrap">
                    <a href="{{ route('himpunan.create') }}" class="btn btn-success float-end">Tambah Himpunan</a>
                    <br><br><br>
                    <table id="basic-datatables" class="table table-striped table-hover">
                        <thead>
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Kriteria</th>
                                <th>Nama</th>
                                <th>Nilai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($himpunans as $key => $himpunan)
                            <tr>
                                <td class="text-center">{{ $key+1 }}</td>
                                <td>{{ $himpunan->kriteria->nama_kriteria }}</td>
                                <td class="text-center">{{ $himpunan->nama }}</td>
                                <td class="text-center">{{ $himpunan->nilai }}</td>
                                <td class="text-center">
                                    <a href="{{ route('himpunan.edit', $himpunan->id) }}" class="btn btn-warning btn-sm btn-flat" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="EDIT">
                                        <i class="bx bx-edit-alt me-1"></i>
                                    </a>
                                    <form action="{{ route('himpunan.destroy', $himpunan->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm btn-flat" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="HAPUS" onclick="return confirm('Yakin ingin menghapus?')">
                                            <i class="bx bx-trash me-1"></i>
                                        </button>
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
<!-- Content wrapper -->

@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $("#basic-datatables").DataTable();
            
        });
    </script>
@endsection