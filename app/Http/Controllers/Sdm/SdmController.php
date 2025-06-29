<?php

namespace App\Http\Controllers\Sdm;

use App\Models\DataSdm;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SdmController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        // Query builder dengan kondisi pencarian
        $data = DataSdm::when($query, function ($q) use ($query) {
            $q->where(function ($subQuery) use ($query) {
                $subQuery->where('uid', 'like', '%' . $query . '%')
                    ->orWhere('nama', 'like', '%' . $query . '%')
                    ->orWhere('no_identitas', 'like', '%' . $query . '%')
                    ->orWhere('instansi', 'like', '%' . $query . '%');
            });
        })->get();

        // return view('admin.sdm.index', compact('data', 'query'));
        return response()->json([
            'status' => 'success',
            'data' => $data,
            'query' => $query
        ]);
    }

    public function edit($id)
    {
        $data = DataSdm::find($id);

        // return view('admin.sdm.update', compact('data'));
        return response()->json([
            'status' => 'success',
            'data' => $data,
            'foto_url' => url('foto/' . $data->foto)
        ]);
    }

    public function update(Request $request, $id)
    {
        // Debug ID dan data request
        // dd($id, $request->all());

        // Validasi data
        $validatedData = $request->validate([
            'uid' => 'required|unique:data_sdms,uid,' . $id,
            'nama' => 'required',
            'foto' => 'nullable|image|max:2024',
            'no_identitas' => 'required|unique:data_sdms,no_identitas,' . $id . '|integer',
            'tempat' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'alamat' => 'required',
            'phone' => 'required|unique:data_sdms,phone,' . $id,
            'kelas_posisi' => 'required',
        ], [
            'required' => ':attribute wajib diisi.',
            'integer' => ':attribute wajib nomor.',
            'unique' => ':attribute sudah terdaftar.',
            'image' => ':attribute harus berupa gambar.',
            'max' => ':attribute maksimal berukuran 2MB.',
            'in' => ':attribute harus diisi dengan "laki-laki" atau "perempuan".',
        ]);
        // return dd('validasi berjalan');

        // Cari data berdasarkan ID
        $data = DataSdm::findOrFail($id);

        // Update semua data kecuali foto
        $data->update(Arr::except($validatedData, ['foto']));

        // Proses foto jika ada
        if ($request->hasFile('foto')) {
            // Validasi folder dan nama file
            $uniq = uniqid();
            $fileName = date('mdY') . $uniq .  $request->file('foto')->getClientOriginalName();
            $request->file('foto')->move('foto', $fileName);

            // Simpan nama file ke database
            $data->foto = $fileName;
            $data->save();
        }

        // return dd($data);

        // Redirect dengan pesan sukses
        // return redirect()->route('sdm')->with('success', 'Data Berhasil diperbarui');
        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diperbarui',
            'data' => $data
        ]);
    }

    public function view($id){
        $data = DataSdm::find($id);
        // return view('admin.sdm.view', compact('data'));
        return response([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function delete($id)
    {
        DataSdm::find($id)->delete();
        // return redirect()->route('sdm')->with('success', 'Data berhasil di hapus');
        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
