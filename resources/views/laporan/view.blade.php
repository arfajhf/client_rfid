@extends('layout.head')
@section('content')
    {{-- <div class="header"> --}}
    <div class="card">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row align-items-center mb-3">
                <div class="col-auto">
                    <h5 class="card-title">
                        Data Presensi Dari
                        {{ \Carbon\Carbon::parse($tgl_awal)->locale('id')->translatedFormat('l, d F Y') }}
                        Sampai {{ \Carbon\Carbon::parse($tgl_akhir)->locale('id')->translatedFormat('l, d F Y') }}
                    </h5>
                </div>
                <div class="col-auto ms-auto">
                    <form action="{{route('download.laporan')}}" method="post">
                        @csrf
                        <input type="hidden" name="tgl_awal" value="{{$tgl_awal}}">
                        <input type="hidden" name="tgl_akhir" value="{{$tgl_akhir}}">
                        <button class="btn btn-outline-success rounded-pill shadow-sm">Download</button>
                    </form>
                    {{-- <a href="#" class="btn btn-outline-success rounded-pill shadow-sm">Download</a> --}}
                </div>
            </div>
            <!-- Table with stripped rows -->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>UID</th>
                            <th>Nama</th>
                            <th>Jam Masuk</th>
                            <th>Jam Keluar</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            {{-- <th class="text-center">Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td> <!-- Loop helper untuk penomoran -->
                                <td>{{ $row->sdm->uid }}</td>
                                <td>{{ $row->sdm->nama }}</td>
                                <td>{{ $row->jam_masuk }}</td>
                                <td>{{ $row->jam_keluar }}</td>
                                <td>{{ $row->setatus }}</td>
                                <td>{{ $row->keterangan }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Invalid Data Not Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- End Table with stripped rows -->

        </div>
        {{-- </div> --}}
    </div>
@endsection
