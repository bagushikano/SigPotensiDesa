<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    protected $table = 'tb_sekolah';

    public $timestamps = false;

    protected $fillable = [
        'id_desa',
        'id_jenis_potensi',
        'nama',
        'jenjang',
        'jenis_sekolah',
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
