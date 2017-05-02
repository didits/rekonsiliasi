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
        'data'
    ];

    public function gardu() {
        return $this->belongsTo('App\organisasi', 'id_gardu');
    }
}
