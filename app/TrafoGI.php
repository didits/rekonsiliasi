<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrafoGI extends Model
{
    protected $table = 'trafo_gi';

    protected $fillable = [
        'id',
        'id_organisasi',
        'id_gi',
        'nama_trafo_gi',
        'alamat_trafo_gi',
        'data_master'
    ];

    public function organisasi() {
        return $this->belongsTo('App\Organisasi', 'id_organisasi');
    }

    public function gi() {
        return $this->belongsTo('App\GI', 'id_gi');
    }
}
