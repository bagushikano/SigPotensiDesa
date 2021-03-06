<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    protected $table = 'tb_desa';

    public $timestamps = false;

    protected $fillable = [
        'nama',
        'warna',
        'batas_wilayah',
    ];

    public function pasar()
    {
        return $this->hasMany(Pasar::class, 'id_desa', 'id');
    }

    public function puspem()
    {
        return $this->hasMany(Puspem::class, 'id_desa', 'id');
    }

    public function sekolah()
    {
        return $this->hasMany(Sekolah::class, 'id_desa', 'id');
    }

    public function tempatIbadah()
    {
        return $this->hasMany(TempatIbadah::class, 'id_desa', 'id');
    }

    public function potensiDesa()
    {
        return $this->hasMany(PotensiDesa::class, 'id_desa', 'id');
    }

    public function kunjungan()
    {
        return $this->hasMany(Kunjungan::class, 'id_desa', 'id');
    }
}
