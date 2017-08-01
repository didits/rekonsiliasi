<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penyulang extends Model
{
    protected $table = 'penyulang';

    protected $fillable = [
        'id',
        'id_organisasi',
        'id_trafo_gi',
        'nama_penyulang',
        'alamat_penyulang',
        'data_master'
    ];

    public function organisasi() {
        return $this->belongsTo('App\Organisasi', 'id_organisasi');
    }

    public function trafo_gi() {
        return $this->belongsTo('App\TrafoGI', 'id_trafo_gi');
    }
}
