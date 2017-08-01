<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GI extends Model
{
    protected $table = 'gi';

    protected $fillable = [
        'id',
        'id_organisasi',
        'nama_gi',
        'alamat_gi',
        'data_master'
    ];

    public function organisasi() {
        return $this->belongsTo('App\Organisasi', 'id_organisasi');
    }
}
