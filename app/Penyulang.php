<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penyulang extends Model
{
    protected $table = 'penyulang';

    protected $fillable = [
        'id',
        'id_gardu',
        'data_master'
    ];

    public function gardu() {
        return $this->belongsTo('App\organisasi', 'id_gardu');
    }
}
