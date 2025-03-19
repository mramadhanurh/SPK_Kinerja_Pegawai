@extends('layouts.home')

@section('title', 'Data Bobot')

@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Tambah Bobot</h5>
                    </div>
                    <div class="card-body">
                        <form id="submitForm">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Nama Bobot</label>
                                <input type="text" class="form-control @error('nama_bobot') is-invalid @enderror" id="nama_bobot" name="nama_bobot" value="{{ old('nama_bobot') }}" placeholder="Masukkan Nama Bobot" />

                                <span class="invalid-feedback" role="alert" id="error-nama_bobot">
                                    <strong></strong>
                                </span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nilai</label>
                                <input type="text" class="form-control @error('nilai') is-invalid @enderror" id="nilai" name="nilai" value="{{ old('nilai') }}" placeholder="Masukkan Nilai" />

                                <span class="invalid-feedback" role="alert" id="error-nilai">
                                    <strong></strong>
                                </span>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Simpan
                            </button>
                            <a href="{{ route('bobot.index') }}" class="btn btn-warning">
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
                    url: `/bobot`,
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
                            window.location.href = "{{ route('bobot.index') }}";
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