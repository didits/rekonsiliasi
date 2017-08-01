<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenyimpananGardu extends Model
{
    protected $table = 'penyimpanan_gardu';

    protected $fillable = [
        'id',
        'id_gardu',
        'periode',
        'data',
        'data_keluar'
    ];

    public function gardu() {
        return $this->belongsTo('App\Gardu', 'id_gardu');
    }
}
