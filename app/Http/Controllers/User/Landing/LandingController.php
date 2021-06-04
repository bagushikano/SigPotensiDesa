<?php

namespace App\Http\Controllers\User\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Model\Desa;
use App\Model\Pasar;
use App\Model\Sekolah;
use App\Model\Puspem;
use App\Model\TempatIbadah;
use App\Model\Kunjungan;

class LandingController extends Controller
{
    public function landing()
    {
        $desa = Desa::whereNotNull('batas_wilayah')->get();
        $pasar = Desa::join('tb_pasar', 'tb_pasar.id_desa', 'tb_desa.id')
            ->select('tb_pasar.*', 'tb_desa.nama AS nama_desa')
            ->where('tb_pasar.deleted_at', NULL)
        ->get();
        $sekolah = Desa::join('tb_sekolah', 'tb_sekolah.id_desa', 'tb_desa.id')
            ->select('tb_sekolah.*', 'tb_desa.nama AS nama_desa')
            ->where('tb_sekolah.deleted_at', NULL)
        ->get();
        $puspem = Desa::join('tb_pusat_pemerintahan', 'tb_pusat_pemerintahan.id_desa', 'tb_desa.id')
            ->select('tb_pusat_pemerintahan.*', 'tb_desa.nama AS nama_desa')
            ->where('deleted_at', NULL)
        ->get();
        $tempatIbadah = Desa::join('tb_tempat_ibadah', 'tb_tempat_ibadah.id_desa', 'tb_desa.id')
            ->select('tb_tempat_ibadah.*', 'tb_desa.nama AS nama_desa')
            ->where('tb_tempat_ibadah.deleted_at', NULL)
        ->get();

        return view('user/landing/index', compact('desa', 'pasar', 'sekolah', 'puspem', 'tempatIbadah'));
    }

    public function tambahKunjungan(Request $request)
    {
        $date = Carbon::now()->setTimezone('GMT+8');
        $thn_kunjungan = $date->format('Y');
        $bln_kunjungan = $date->format('m');
        $tgl_kunjungan = $date->format('d');

        Kunjungan::create([
            'id_desa' => $request->id_desa,
            'id_potensi_desa' => $request->id_potensi_desa,
            'jenis_potensi' => $request->jenis_potensi,
            'jumlah_kunjungan' => 1,
            'tanggal_kunjungan' => $tgl_kunjungan,
            'bulan_kunjungan' => $bln_kunjungan,
            'tahun_kunjungan' => $thn_kunjungan,
        ]);
    }
}
