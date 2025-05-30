<?php

namespace App\Http\Controllers;

use App\Models\DataInvalid;
use Carbon\Carbon;
use App\Models\DataSdm;
use App\Models\DataPresensi;
use Illuminate\Http\Request;

class RfidController extends Controller
{
    public function capture(Request $request, $uid)
    {
        $sdm = DataSdm::where('uid', $uid)->first();

        if ($sdm) {
            $today = Carbon::now()->toDateString();
            // return dd($today);
            $cek = DataPresensi::where('id_sdm', $sdm->id)->whereDate('created_at', $today)->first();
            // return dd($cek);
            if ($cek) {
                $cek->update([
                    'jam_keluar' => date('H:i:s'),
                    'setatus' => 'out'
                ]);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Absensi berhasil diedit',
                    'data' => $cek
                ]);
            } else {
                $data = DataPresensi::create([
                    'id_sdm' => $sdm->id,
                    'jam_masuk' => date('H:i:s'),
                    'setatus' => 'in',
                    'keterangan' => 'hadir'
                ]);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Berhasil melakukan absen',
                    'data' => $data,
                    'sdm' => $sdm
                ]);
            }
        } else {
            $invalide = DataInvalid::create([
                'uid' => $uid
            ]);

            return response()->json([
                'status' => 'invalide',
                'message' => 'Kartu Belum terdaftar di aplikasi',
                'data' => $invalide
            ]);
        }


        // if ($sdm){
        //     $data = DataPresensi::create([
        //         'id_sdm' => $sdm->id,
        //         'jam_masuk' => date('H:i:s'),
        //         'setatus' => 'in',
        //         'keterangan' => 'hadir'
        //     ]);

        //     return response()->json([
        //         'status' => 'success',
        //         'message' => 'Berhasil melakukan absen',
        //         'data' => $data
        //     ]);
        // }else{
        //     return response()->json([
        //         'status' => 'invalide',
        //         'message' => 'Kartu Belum terdaftar di aplikasi'
        //     ]);
        // }
        // return response()->json(['status' => 'success', 'rfid' => $rfid]);
    }

    public function outCapture($uid)
    {
        $sdm = DataSdm::where('uid', $uid)->first();

        if ($sdm) {
            $presensi = DataPresensi::where('id_sdm', $sdm->id)->first();
            if ($presensi) {
                $today = Carbon::now()->toDateString();
                $cek = $presensi->whereDate('created_at', $today);
                if ($cek) {
                    $presensi->update([
                        'jam_keluar' => date('H:i:s'),
                        'setatus' => 'out'
                    ]);
                }
            }
        }
    }
}
