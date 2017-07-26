<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penyulang extends Model
{
    protected $table = 'trafo_gi';

    protected $fillable = [
        'id',
        'id_gardu',
        'nama_penyulang',
        'alamat_penyulang',
        'data_master'
    ];

    public function gardu() {
        return $this->belongsTo('App\organisasi', 'id_gardu');
    }
}
