@extends('layouts.home')

@section('title', 'Data Pegawai')

@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Tambah Pegawai</h5>
                    </div>
                    <div class="card-body">
                        <form id="submitForm">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Masukkan Nama" />

                                <span class="invalid-feedback" role="alert" id="error-nama">
                                    <strong></strong>
                                </span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">NIP</label>
                                <input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip" name="nip" value="{{ old('nip') }}" placeholder="Masukkan NIP" />

                                <span class="invalid-feedback" role="alert" id="error-nip">
                                    <strong></strong>
                                </span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Pangkat</label>
                                <select id="id_pangkat" name="id_pangkat" class="form-select form-control @error('id_pangkat') is-invalid @enderror" value="{{ old('id_pangkat') }}">
                                    <option selected value="" disabled>-- Pilih Pangkat --</option>
                                    @foreach ($pangkats as $pangkat)
                                    <option value="{{ $pangkat->id }}">{{ $pangkat->pangkat }}</option>
                                    @endforeach
                                </select>

                                <span class="invalid-feedback" role="alert" id="error-id_pangkat">
                                    <strong></strong>
                                </span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Jabatan</label>
                                <select id="id_jabatan" name="id_jabatan" class="form-select form-control @error('id_jabatan') is-invalid @enderror" value="{{ old('id_jabatan') }}">
                                    <option selected value="" disabled>-- Pilih Jabatan --</option>
                                    @foreach ($jabatans as $jabatan)
                                    <option value="{{ $jabatan->id }}">{{ $jabatan->jabatan }}</option>
                                    @endforeach
                                </select>

                                <span class="invalid-feedback" role="alert" id="error-id_jabatan">
                                    <strong></strong>
                                </span>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Simpan
                            </button>
                            <a href="{{ route('pegawai.index') }}" class="btn btn-warning">
                                Kembali
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')

@endsection

@section('js')
<script>
    $(document).ready(function() {

        $('#submitForm').on('submit', function(event) {
            event.preventDefault();

            $('.invalid-feedback').children('strong').text('');
            $('.form-control').removeClass('is-invalid');

            var formData = new FormData(this);

            $.ajax({
                url: `/pegawai`,
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    Swal.fire({
                        title: "Berhasil!",
                        text: "Data berhasil disimpan!",
                        icon: "success",
                        buttons: {
                            confirm: {
                                text: "Oke",
                                value: true,
                                visible: true,
                                className: "btn btn-success",
                            },
                        },
                    }).then(() => {
                        window.location.href = "{{ route('pegawai.index') }}";
                    });
                },
                error: function(xhr, status, error) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('#error-' + key).children('strong').text(value[0]);
                            $('#' + key).addClass('is-invalid');
                        });
                    } else {
                        Swal.fire({
                            title: "Error!",
                            text: "Terjadi kesalahan: " + (xhr.responseJSON
                                .message || error),
                            icon: "error",
                            buttons: {
                                confirm: {
                                    className: "btn btn-danger",
                                },
                            },
                        });
                    }
                }
            });
        });

    });
</script>
@endsection