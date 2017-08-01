<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenyimpananPenyulang extends Model
{
    protected $table = 'penyimpanan_penyulang';

    protected $fillable = [
        'id',
        'id_penyulang',
        'periode',
        'data',
        'data_keluar'
    ];

    public function penyulang() {
        return $this->belongsTo('App\Penyulang', 'id_penyulang');
    }
}
