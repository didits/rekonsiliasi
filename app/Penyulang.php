<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Transfer;
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

    public function getIdOrganisasiAttribute($value){
        //$this->attributes['id_organisasi'] = "asa";
        return "asa";
//        $data = Transfer::where('id_organisasi',$value);
//        if($data->count()>0){
//            $data = $data->first();
//            return $data->id_penyulang;
//        }
//        else{
//            return $value;
//        }


    }
}
