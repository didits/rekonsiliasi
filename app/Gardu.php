<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gardu extends Model
{
    protected $table = 'gardu';

    protected $fillable = [
        'id',
        'id_organisasi',
        'nama_gardu',
        'alamat_gardu',
        'data_master'
    ];

    public function organisasi() {
        return $this->belongsTo('App\organisasi', 'id_organisasi');
    }
}
