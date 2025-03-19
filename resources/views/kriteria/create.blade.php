@extends('layouts.home')

@section('title', 'Data Kriteria')

@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Tambah Kriteria</h5>
                    </div>
                    <div class="card-body">
                        <form id="submitForm">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Nama Kriteria</label>
                                <input type="text" class="form-control @error('nama_kriteria') is-invalid @enderror" id="nama_kriteria" name="nama_kriteria" value="{{ old('nama_kriteria') }}" placeholder="Masukkan Nama Kriteria" />

                                <span class="invalid-feedback" role="alert" id="error-nama_kriteria">
                                    <strong></strong>
                                </span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Atribut</label>
                                <select class="form-control @error('atribut') is-invalid @enderror" id="atribut" name="atribut">
                                    <option selected value="" disabled>-- Pilih Atribut --</option>
                                    <option value="benefit" {{ old('atribut') == 'benefit' ? 'selected' : '' }}>Benefit</option>
                                    <option value="cost" {{ old('atribut') == 'cost' ? 'selected' : '' }}>Cost</option>
                                </select>

                                <span class="invalid-feedback" role="alert" id="error-atribut">
                                    <strong></strong>
                                </span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Bobot Kriteria</label>
                                <input type="text" class="form-control @error('bobot_kriteria') is-invalid @enderror" id="bobot_kriteria" name="bobot_kriteria" value="{{ old('bobot_kriteria') }}" placeholder="Masukkan Bobot Kriteria" />

                                <span class="invalid-feedback" role="alert" id="error-bobot_kriteria">
                                    <strong></strong>
                                </span>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Simpan
                            </button>
                            <a href="{{ route('kriteria.index') }}" class="btn btn-warning">
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
                    url: `/kriteria`,
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
                            window.location.href = "{{ route('kriteria.index') }}";
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