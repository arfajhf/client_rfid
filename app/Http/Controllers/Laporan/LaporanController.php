<?php

namespace App\Http\Controllers\Laporan;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\DataPresensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;

class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan.index');
    }

    public function views(Request $request)
    {
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal'
        ]);
        App::setLocale('id');
        Carbon::setLocale('id');

        $tgl_awal = $request->tanggal_awal;
        $tgl_akhir = $request->tanggal_akhir;

        $data = DataPresensi::whereDate('created_at', '>=', $request->tanggal_awal)
            ->whereDate('created_at', '<=', $request->tanggal_akhir)
            ->where('setatus', 'out')
            ->get();

        // return view('laporan.view', compact('data', 'tgl_awal', 'tgl_akhir'));
        return response()->json([
            'status' => 'success',
            'data' => $data,
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir
        ]);
    }

    public function CsvDownload(Request $request)
    {
        $data = DataPresensi::whereDate('created_at', '>=', $request->tgl_awal)
            ->whereDate('created_at', '<=', $request->tgl_akhir)
            ->where('setatus', 'out')
            ->get();

        $callback = function () use ($data) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['No', 'UID', 'Nama', 'Jam Masuk', 'Jam Keluar', 'Status', 'Keterangan', 'Tanggal']);

            $no = 1;

            foreach ($data as $row) {
                fputcsv($file, [
                    $no++,
                    $row->sdm->uid,
                    $row->sdm->nama,
                    $row->jam_masuk,
                    $row->jam_keluar,
                    $row->setatus,
                    $row->keterangan,
                    Carbon::parse($row->created_at)->format('d F Y')
                ]);
            }

            fclose($file);
        };
        $nameRan = Str::random(5);
        $name = 'Laporan_Presensi_' . $nameRan . '.csv';
        return response()->streamDownload($callback, $name, [
            'Content-Type' => 'text/csv',
        ]);
    }
}
