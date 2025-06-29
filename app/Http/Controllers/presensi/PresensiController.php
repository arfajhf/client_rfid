<?php

namespace App\Http\Controllers\presensi;

use App\Http\Controllers\Controller;
use App\Models\DataPresensi;
use App\Models\DataSdm;
use Illuminate\Http\Request;
use Soap\Sdl;

class PresensiController extends Controller
{
    public function index(Request $request){
        $query = $request->input('query');

        $data = DataPresensi::with('sdm')->whereHas('sdm', function ($q) use ($query){
            $q->where('uid', 'like', '%' . $query . '%')
            ->orWhere('nama', 'like', '%' . $query . '%');
        })->get();

        foreach ($data as $item) {
            $sdm = DataSdm::find($item->sdm_id);
        }
        // $d = bcrypt(hash('$P$BOnq3gmqwY3Tv5H2DVAfAnR2N9vMwi0'));

        // return view('admin.presensi.index', compact('data'));
        return response()->json([
            'status' => 'success',
            'data' => $data,
            'query' => $query
        ]);
    }
}
