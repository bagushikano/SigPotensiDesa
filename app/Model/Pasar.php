<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pasar extends Model
{
    protected $table = 'tb_pasar';

    public $timestamps = false;

    protected $fillable = [
        'id_desa',
        'id_jenis_potensi',
        'nama',
        'alamat',
        'lat',
        'lng',
        'deleted_at',
    ];

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'id_desa', 'id');
    }

    public function jenisPotensi()
    {
        return $this->hasMany(Desa::class, 'id_jenis_potensi', 'id');
    }
}
