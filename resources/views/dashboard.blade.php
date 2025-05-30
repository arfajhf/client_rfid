@extends('layout.head')
@section('content')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">

                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">Data SDM</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-file-earmark-person"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $sdm }} Orang</h6>
                                        <span class="text-muted small pt-2 ps-1"><a href="{{ route('sdm') }}">View <i
                                                    class="bi bi-arrow-right"></i></a></span>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">

                            <div class="card-body">
                                <h5 class="card-title">Data Invalid</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-question-circle"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $invalide }} Data</h6>
                                        <span class="text-muted small pt-2 ps-1"><a href="{{ route('invalid') }}">View <i
                                                    class="bi bi-arrow-right"></i></a></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Revenue Card -->
                    {{-- <div class="col-xxl-4 col-md-4">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">Data Sekolah</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-card-list"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $sekolah }} Sekolah</h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div> --}}
                    <div class="col-xxl-4 col-xl-12">
                        <div class="card info-card customers-card">

                            <div class="card-body">
                                <h5 class="card-title">Data Presensi</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-card-list"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$presensi}} Data</h6>
                                        <span class="text-muted small pt-2 ps-1"><a href="{{ route('data.presensi') }}">View <i
                                            class="bi bi-arrow-right"></i></a></span>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
