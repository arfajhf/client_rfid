<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSdm extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function presensi(){
        return $this->hasMany(DataPresensi::class, 'id_sdm', 'id');
    }
}
