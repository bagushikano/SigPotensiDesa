<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class JenisPotensi extends Model
{
    protected $table = 'tb_jenis_potensi';

    public $timestamps = false;

    protected $fillable = [
        'jenis_potensi',
        'alamat',
    ];

    public function pasar()
    {
        return $this->belongsTo(Pasar::class);
    }

    public function puspem()
    {
        return $this->belongsTo(Puspem::class);
    }

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }

    public function tempatIbadah()
    {
        return $this->belongsTo(TempatIbadah::class);
    }
}
