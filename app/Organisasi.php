<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Organisasi extends Authenticatable
{
    use Notifiable;
    protected $table = 'organisasi';
    protected $guard = 'organisasi';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_organisasi', 'password', 'tipe_organisasi', 'nama_organisasi', 'nama_daerah', 'alamat',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
