<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenyimpananGI extends Model
{
    protected $table = 'penyimpanan_gi';

    protected $fillable = [
        'id',
        'id_gi',
        'periode',
        'data',
        'data_keluar'
    ];

    public function gi() {
        return $this->belongsTo('App\GI', 'id_gi');
    }
}
