<?php

namespace App\Http\Controllers\Sdm;

use App\Http\Controllers\Controller;
use App\Models\DataSdm;
use Illuminate\Http\Request;

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

        return view('admin.sdm.index', compact('data', 'query'));
    }

    public function edit($id){
        $data = DataSdm::find($id);

        return view('admin.sdm.update', compact('data'));
    }

    public function delete($id){
        DataSdm::find($id)->delete();
        return redirect()->route('sdm')->with('success', 'Data berhasil di hapus');
    }

}
