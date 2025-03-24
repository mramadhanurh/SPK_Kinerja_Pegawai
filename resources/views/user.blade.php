@extends('layouts.home')

@section('title', 'Dashboard User')

@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-8 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Halo {{ Auth::user()->name }}</h5>
                                <p class="mb-4">
                                    Selamat Datang di <span class="fw-medium">SPK Kinerja Pegawai</span> <br>
                                    Pada Kantor Badan Kesatuan Bangsa dan Politik <span class="fw-medium">Provinsi Papua Barat</span>
                                </p>

                                <br>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-3 px-0 px-md-4">
                                <img src="{{ asset('template/assets/img/illustrations/papua_barat.png') }}" height="140" alt="View Badge User" data-app-dark-img="illustrations/papua_barat.png" data-app-light-img="illustrations/papua_barat.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 order-1">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('template/assets/img/icons/unicons/chart-success.png') }}" alt="chart success" class="rounded" />
                                    </div>
                                </div>
                                <span class="d-block mb-1">Pegawai</span>
                                <h3 class="card-title mb-2">{{ $pegawais }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('template/assets/img/icons/unicons/chart-success.png') }}" alt="chart success" class="rounded" />
                                    </div>
                                </div>
                                <span class="fw-medium d-block mb-1">Jabatan</span>
                                <h3 class="card-title text-nowrap mb-1">{{ $jabatans }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Total Revenue -->
            <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">

            </div>
            <!--/ Total Revenue -->
            <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                <div class="row">
                    <div class="col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('template/assets/img/icons/unicons/chart-success.png') }}" alt="chart success" class="rounded" />
                                    </div>
                                </div>
                                <span class="d-block mb-1">Kriteria</span>
                                <h3 class="card-title text-nowrap mb-2">{{ $kriterias }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('template/assets/img/icons/unicons/chart-success.png') }}" alt="chart success" class="rounded" />
                                    </div>
                                </div>
                                <span class="fw-medium d-block mb-1">Himpunan</span>
                                <h3 class="card-title mb-2">{{ $himpunans }}</h3>
                            </div>
                        </div>
                    </div>
                    <!-- </div>
    <div class="row"> -->

                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->

    @include('layouts.footer')

    <div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->

@endsection