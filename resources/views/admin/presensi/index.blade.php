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
            <h5 class="card-title">Data Presensi</h5>

            <div class="search-bar header align-items-center d-flex">
                <form class="search-form d-flex align-items-center" method="GET" action="/presensi">
                    <input type="text" name="query" placeholder="Masukan UID/Nama/No Identitas/Nama Instansi" value="{{ $query ?? '' }}">
                    <button type="submit"><i class="bi bi-search"></i></button>
                </form>
            </div><!-- End Search Bar -->
            {{-- </div> --}}
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
                                {{-- <td class="text-center">
                                    <a href="/sdm/view/{{$row->id}}" class="btn btn-info">View</a>
                                    <a href="/sdm/update/{{$row->id}}" class="btn btn-success">Update</a>
                                    <a href="" class="btn btn-danger">Delete</a>
                                    <form action="/sdm/delete/{{ $row->id }}" method="get"
                                        class="form-basic d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Apa anda yakin ingin menghapus data ini?')">Delete</button>
                                    </form>
                                </td> --}}
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
