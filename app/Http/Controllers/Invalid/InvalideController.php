<?php

namespace App\Http\Controllers\Invalid;

use App\Http\Controllers\Controller;
use App\Models\DataInvalid;
use Illuminate\Http\Request;

class InvalideController extends Controller
{
    public function index(Request $request){
        $query = $request->input('query');

        $data = DataInvalid::query()
            ->when($query, function($q) use ($query){
                $q->where('uid', 'like', '%' . $query . '%');
            })
            ->get();
        return view('invalid.index', compact('data', 'query'));
    }
}
