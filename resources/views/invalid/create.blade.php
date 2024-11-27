@extends('layout.head')
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Create Data SDM</h5>

            <!-- General Form Elements -->
            <form action="/invalid/create" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label for="uid" class="col-sm-2 col-form-label">UID</label>
                    <div class="col-sm-10">
                        <input type="hidden" name="uid" class="form-control" value="{{ $invalid->uid }}">
                        <input type="text" class="form-control" value="{{ $invalid->uid }}" disabled>
                        @error('uid')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama" value="{{ old('nama') }}"
                            placeholder="Masukan Nama">
                        @error('nama')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="foto" class="col-sm-2 col-form-label">Upload Foto</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="file" name="foto" id="foto">
                        @error('foto')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="no_identitas" class="col-sm-2 col-form-label">Nomor Identitas</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="no_identitas" value="{{ old('no_identitas') }}"
                            placeholder="Masukan NIS/Nik">
                        @error('no_identitas')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="tempat" class="col-sm-2 col-form-label">Tempat Lahir</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="tempat" value="{{ old('tempat') }}"
                            placeholder="Masukan Tempat Lahir">
                        @error('tempat')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                        @error('tanggal_lahir')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0">Jenis Kelamin</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki-laki"
                                value="laki-laki" {{ old('jenis_kelamin') == 'laki-laki' ? 'checked' : '' }}>
                            <label class="form-check-label" for="laki-laki">Laki-laki</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan"
                                value="perempuan" {{ old('jenis_kelamin') == 'perempuan' ? 'checked' : '' }}>
                            <label class="form-check-label" for="perempuan">Perempuan</label>
                        </div>
                        @error('jenis_kelamin')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </fieldset>

                <div class="row mb-3">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" style="height: 100px" name="alamat" placeholder="Masukan Alamat">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="nohp" class="col-sm-2 col-form-label">Nomor Handphone</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="phone" value="{{ old('phone') }}"
                            placeholder="Masukan Nomor Handphone dengan Format +62">
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="posisi" class="col-sm-2 col-form-label">Kelas/Posisi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="kelas_posisi" value="{{ old('kelas_posisi') }}"
                            placeholder="Masukan Kelas/Posisi">
                        @error('kelas_posisi')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="instansi" class="col-sm-2 col-form-label">Nama Instansi</label>
                    <div class="col-sm-10">
                        <select name="instansi" id="instansi" class="form-control">
                            <option selected disabled>Pilih Instansi</option>
                            @foreach ($penyewa as $data)
                                <option value="{{ $data->nama }}"
                                    {{ old('instansi') == $data->nama ? 'selected' : '' }}>{{ $data->nama }}</option>
                            @endforeach
                        </select>
                        @error('instansi')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-info">Create</button>
                    </div>
                </div>
            </form><!-- End General Form Elements -->

        </div>
    </div>
@endsection
