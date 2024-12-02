@extends('layout.head');
@section('content')

    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h5>View Data {{$data->nama}}</h5>
                <h5>Instansi {{$data->instansi}}</h5>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <br>
                    <img src="{{url('foto/' . $data->foto)}}" width="40%" alt="">
                </div>
                <div class="col-md-6">
                    <br>
                    <br>
                    <h5>UID : {{ $data->uid }}</h5>
                    <h5>No Identitas : {{ $data->no_identitas }}</h5>
                    <h5>Nama : {{ $data->nama }}</h5>
                    <h5>Tempat,Tanggal Lahir : {{ $data->tempat }}, {{ $data->tanggal_lahir }}</h5>
                </div>

                <div class="col-md-6">
                    <br>
                    <br>
                    <h5>Jenis Kelamin : {{ $data->jenis_kelamin }}</h5>
                    <h5>Alamat : {{ $data->alamat }}</h5>
                    <h5>No Handphone : {{ $data->phone }}</h5>
                    <h5>Kelas Atau Posisi : {{ $data->kelas_posisi }}</h5>
                </div>
            </div>
        </div>
    </div>

@endsection
