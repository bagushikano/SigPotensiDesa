<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    protected $table = 'tb_kunjungan';

    public $timestamps = false;

    protected $fillable = [
        'id_potensi_desa',
        'id_desa',
        'jenis_potensi',
        'jumlah_kunjungan',
        'tanggal_kunjungan',
        'bulan_kunjungan',
        'tahun_kunjungan',
    ];
    
    public function desa()
    {
        return $this->belongsTo(Desa::class, 'id_desa', 'id');
    }
}
