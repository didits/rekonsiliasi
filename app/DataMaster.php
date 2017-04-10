<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataMaster extends Model
{
    protected $table = 'data_master';

    protected $fillable = [
        'id_organisasi',
        'alatpengukuran',
        'pembacaanmeter'
    ];

    public function user() {
        return $this->belongsTo('App\User', 'id_user');
    }
}
