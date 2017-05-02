<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenyimpananPenyulang extends Model
{
    protected $table = 'gardu';

    protected $fillable = [
        'id',
        'id_penyulang',
        'periode',
        'data_master'
    ];

    public function penyulang() {
        return $this->belongsTo('App\organisasi', 'id_penyulang');
    }
}
