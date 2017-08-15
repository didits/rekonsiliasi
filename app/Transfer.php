<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $table = 'transfer';

    protected $fillable = [
        'id',
        'id_organisasi',
        'id_gi',
        'id_penyulang'
    ];

    public function organisasi() {
        return $this->belongsTo('App\Organisasi', 'id_organisasi');
    }

    public function gi() {
        return $this->belongsTo('App\GI', 'id_gi');
    }

    public function penyulang() {
        return $this->belongsTo('App\Penyulang', 'id_penyulang');
    }
}
