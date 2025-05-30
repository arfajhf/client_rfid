<?php

namespace App\Http\Controllers\presensi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LivePresensiController extends Controller
{
    public function index(){
        return view('live_presensi.index');
    }
}
