<?php

namespace App\Http\Controllers;

use App\Models\DataInvalid;
use Carbon\Carbon;
use App\Models\DataSdm;
use App\Models\DataPresensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;
use App\Events\PresensiEvent;

class RfidController extends Controller
{
    public function capture(Request $request, $uid)
    {
        // $sdm = DataSdm::where('uid', $uid)->first();

        // if ($sdm) {
        //     $today = Carbon::now()->toDateString();
        //     // return dd($today);
        //     $cek = DataPresensi::where('id_sdm', $sdm->id)->whereDate('created_at', $today)->first();
        //     // return dd($cek);
        //     if ($cek) {
        //         $cek->update([
        //             'jam_keluar' => date('H:i:s'),
        //             'setatus' => 'out'
        //         ]);

        //         return response()->json([
        //             'status' => 'success',
        //             'message' => 'Absensi berhasil diedit',
        //             'data' => $cek
        //         ]);
        //     } else {
        //         $data = DataPresensi::create([
        //             'id_sdm' => $sdm->id,
        //             'jam_masuk' => date('H:i:s'),
        //             'setatus' => 'in',
        //             'keterangan' => 'hadir'
        //         ]);

        //         return response()->json([
        //             'status' => 'success',
        //             'message' => 'Berhasil melakukan absen',
        //             'data' => $data,
        //             'sdm' => $sdm
        //         ]);
        //     }
        // } else {
        //     $invalide = DataInvalid::create([
        //         'uid' => $uid
        //     ]);

        //     return response()->json([
        //         'status' => 'invalide',
        //         'message' => 'Kartu Belum terdaftar di aplikasi',
        //         'data' => $invalide
        //     ]);
        // }

        $sdm = DataSdm::where('uid', $uid)->first();

        if ($sdm) {
            $today = Carbon::now()->toDateString();
            $cek = DataPresensi::where('id_sdm', $sdm->id)->whereDate('created_at', $today)->first();

            if ($cek) {
                $cek->update([
                    'jam_keluar' => now()->format('H:i:s'),
                    'setatus' => 'out'
                ]);

                // Broadcast event
                Broadcast::event(new PresensiEvent([
                    'nama' => $sdm->nama,
                    'status' => 'Keluar',
                    'waktu' => now()->format('H:i:s')
                ]));

                return response()->json([
                    'status' => 'success',
                    'message' => 'Absen keluar berhasil',
                    'data' => $cek
                ]);
            } else {
                $data = DataPresensi::create([
                    'id_sdm' => $sdm->id,
                    'jam_masuk' => now()->format('H:i:s'),
                    'setatus' => 'in',
                    'keterangan' => 'hadir'
                ]);

                // Broadcast event
                Broadcast::event(new PresensiEvent([
                    'nama' => $sdm->nama,
                    'status' => 'Masuk',
                    'waktu' => now()->format('H:i:s')
                ]));

                return response()->json([
                    'status' => 'success',
                    'message' => 'Berhasil melakukan absen masuk',
                    'data' => $data,
                    'sdm' => $sdm
                ]);
            }
        } else {
            // UID tidak terdaftar
            $invalid = DataInvalid::create([
                'uid' => $uid
            ]);

            // Broadcast event
            Broadcast::event(new PresensiEvent([
                'nama' => 'Tidak Dikenali',
                'status' => 'invalid',
                'waktu' => now()->format('H:i:s')
            ]));

            return response()->json([
                'status' => 'invalid',
                'message' => 'UID tidak dikenali',
                'data' => $invalid
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
