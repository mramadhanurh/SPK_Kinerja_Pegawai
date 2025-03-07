@extends('layouts.home')

@section('title', 'Data Jabatan')

@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit Jabatan</h5>
                    </div>
                    <div class="card-body">
                        <form id="submitForm">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Jabatan</label>
                                <input type="text" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan" value="{{ $jabatan->jabatan }}" />

                                <span class="invalid-feedback" role="alert" id="error-jabatan">
                                    <strong></strong>
                                </span>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                            <a href="{{ route('jabatan.index') }}" class="btn btn-warning">
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
                    url: "{{ route('jabatan.update', $jabatan->id) }}",
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        Swal.fire({
                            title: "Berhasil!",
                            text: "Data berhasil diperbarui!",
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
                            window.location.href = "{{ route('jabatan.index') }}";
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