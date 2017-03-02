<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // <-- This is required

class Listrik extends Model
{
    use SoftDeletes;
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
