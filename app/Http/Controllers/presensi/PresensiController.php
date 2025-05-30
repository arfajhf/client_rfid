<?php

namespace App\Http\Controllers\presensi;

use App\Http\Controllers\Controller;
use App\Models\DataPresensi;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    public function index(Request $request){
        $query = $request->input('query');

        $data = DataPresensi::whereHas('sdm', function ($q) use ($query){
            $q->where('uid', 'like', '%' . $query . '%')
            ->orWhere('nama', 'like', '%' . $query . '%');
        })->get();

        // $d = bcrypt(hash('$P$BOnq3gmqwY3Tv5H2DVAfAnR2N9vMwi0'));

        return view('admin.presensi.index', compact('data'));
    }

    // public function getNameInArduiono(){

    // }
}
