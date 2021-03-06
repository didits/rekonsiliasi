<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gardu extends Model
{
    protected $table = 'gardu';

    protected $fillable = [
        'id',
        'id_organisasi',
        'id_penyulang',
        'nama_gardu',
        'tujuan',
        'alamat_gardu',
        'data_master',
        'rincian'
    ];

    public function organisasi() {
        return $this->belongsTo('App\Organisasi', 'id_organisasi');
    }

    public function penyulang() {
        return $this->belongsTo('App\Penyulang', 'id_penyulang');
    }
}
