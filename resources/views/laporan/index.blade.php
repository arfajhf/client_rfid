@extends('layout.head')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-7 col-xl-7 col-lg-7 col-7">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Laporan Pertanggal</h5>

                    <!-- General Form Elements -->
                    <form action="{{route('view.laporan')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="tanggal_akhir" class="col-sm-2 col-form-label">Tanggal Awal</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="tanggal_awal">
                                @error('tanggal_akhir')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tanggal_akhir" class="col-sm-2 col-form-label">Tanggal Akhir</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="tanggal_akhir">
                                @error('tanggal_akhir')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-info">Submit</button>
                            </div>
                        </div>
                    </form><!-- End General Form Elements -->

                </div>
            </div>
        </div>
    </div>
@endsection
