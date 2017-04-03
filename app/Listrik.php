<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listrik extends Model
{
    protected $table = 'listrik';

    protected $fillable = [
        'id_organisasi',
        'tahun_bulan',
        'tipe_listrik',
        'data'
    ];

    public function user() {
        return $this->belongsTo('App\User', 'id_user');
    }
}
