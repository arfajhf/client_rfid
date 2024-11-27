<?php

namespace App\Http\Controllers\Invalid;

use App\Http\Controllers\Controller;
use App\Models\DataInvalid;
use App\Models\DataPenyewa;
use App\Models\DataSdm;
use Illuminate\Http\Request;

class InvalideController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        $data = DataInvalid::query()
            ->when($query, function ($q) use ($query) {
                $q->where('uid', 'like', '%' . $query . '%');
            })
            ->get();
        return view('invalid.index', compact('data', 'query'));
    }

    public function create($id)
    {
        $invalid = DataInvalid::find($id);
        $penyewa = DataPenyewa::all();
        return view('invalid.create', compact('invalid', 'penyewa'));
    }

    public function store(Request $request)
    {
        // return dd($request->all());
        $request->validate([
            'uid' => 'required|unique:data_sdms,uid',
            'nama' => 'required',
            'foto' => 'required|image|max:2024',
            'no_identitas' => 'required|unique:data_sdms,no_identitas|integer',
            'tempat' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'alamat' => 'required',
            'phone' => 'required|unique:data_sdms,phone',
            'kelas_posisi' => 'required',
            'instansi' => 'required'
        ], [
            'required' => ':attribute wajib diisi.',
            'integer' => ':attribute wajib nomor',
            'unique' => ':attribute sudah terdaftar.',
            'image' => ':attribute harus berupa gambar.',
            'max' => ':attribute maksimal berukuran 2MB.',
            'in' => ':attribute harus diisi dengan "laki-laki" atau "perempuan".'
        ]);

        // $data = DataSdm::create([
        //     ...$request->all(),
        //     'foto' => $request->file('foto')->move('foto', $request->file('foto')->getClientOriginalName())
        // ]);
        // return dd($data);

        // $data = DataSdm::create([
        //     'uid',
        //     'nama',
        //     'foto',
        //     'no_identitas',
        //     'tempat',
        //     'tanggal_lahir',
        //     'jenis_kelamin',
        //     'alamat',
        //     'phone',
        //     'kelas_posisi',
        //     'instansi'
        // ]);
        // $request->tanggal_lahir = date(format(dd-mm-yy));

        $data = DataSdm::create($request->all());

        // return dd($data);

        if($request->hasFile('foto')){
            $request->file('foto')->move('foto', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }



        return redirect()->route('invalid')->with('success', 'Data Berhasil ditambahkan');
    }
}
