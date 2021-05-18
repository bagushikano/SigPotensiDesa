<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PotensiDesa extends Model
{
    protected $table = 'tb_potensi_desa';

    public $timestamps = false;

    protected $fillable = [
        'id_desa',
        'sekolah',
        'pasar',
        'pusat_pemerintahan',
        'tempat_ibadah',
    ];
    
    public function desa()
    {
        return $this->belongsTo(Desa::class, 'id_desa', 'id');
    }
}
