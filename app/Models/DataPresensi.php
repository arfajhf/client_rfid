<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPresensi extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function sdm(){
        return $this->belongsTo(DataSdm::class, 'id_sdm', 'id');
    }
}
