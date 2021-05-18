<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'tb_admin';

    protected $guard = 'admin';

    public $timestamps = false;

    protected $fillable = [
        'nama',
        'alamat',
        'nomor_telepon',
        'username',
        'password',
    ];
}
