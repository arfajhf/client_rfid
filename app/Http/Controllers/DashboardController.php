<?php

namespace App\Http\Controllers;

use App\Models\DataInvalid;
use App\Models\DataPenyewa;
use App\Models\DataPresensi;
use App\Models\DataSdm;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $sdm = DataSdm::count();
        $invalide = DataInvalid::count();
        $presensi = DataPresensi::count();
        $sekolah = DataPenyewa::count();

        // return view('dashboard', compact(
        //     'sdm',
        //     'invalide',
        //     'presensi',
        //     'sekolah'
        // ));
        return response()->json([
            'status' => 'success',
            'data' => [
                'sdm' => $sdm,
                'invalide' => $invalide,
                'presensi' => $presensi,
                'sekolah' => $sekolah
            ]
        ]);
    }
}
