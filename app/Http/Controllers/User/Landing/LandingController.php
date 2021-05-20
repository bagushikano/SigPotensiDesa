<?php

namespace App\Http\Controllers\User\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Desa;
use App\Model\Pasar;
use App\Model\Sekolah;
use App\Model\Puspem;
use App\Model\TempatIbadah;

class LandingController extends Controller
{
    public function landing()
    {
        $desa = Desa::whereNotNull('batas_wilayah')->get();
        $pasar = Desa::join('tb_pasar', 'tb_pasar.id_desa', 'tb_desa.id')
            ->select('tb_pasar.*', 'tb_desa.nama AS nama_desa')
            ->where('deleted_at', NULL)
        ->get();
        $sekolah = Desa::join('tb_sekolah', 'tb_sekolah.id_desa', 'tb_desa.id')
            ->select('tb_sekolah.*', 'tb_desa.nama AS nama_desa')
            ->where('deleted_at', NULL)
        ->get();
        $puspem = Desa::join('tb_pusat_pemerintahan', 'tb_pusat_pemerintahan.id_desa', 'tb_desa.id')
            ->select('tb_pusat_pemerintahan.*', 'tb_desa.nama AS nama_desa')
            ->where('deleted_at', NULL)
        ->get();
        $tempatIbadah = Desa::join('tb_tempat_ibadah', 'tb_tempat_ibadah.id_desa', 'tb_desa.id')
            ->select('tb_tempat_ibadah.*', 'tb_desa.nama AS nama_desa')
            ->where('deleted_at', NULL)
        ->get();

        return view('user/landing/index', compact('desa', 'pasar', 'sekolah', 'puspem', 'tempatIbadah'));
    }
}
