<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenyimpananTrafoGI extends Model
{
    protected $table = 'penyimpanan_trafo_gi';

    protected $fillable = [
        'id',
        'id_gardu',
        'id_trafo_gi',
        'periode',
        'data',
        'data_keluar'
    ];

    public function trafo_gi() {
        return $this->belongsTo('App\TrafoGI', 'id_trafo_gi');
    }
}
