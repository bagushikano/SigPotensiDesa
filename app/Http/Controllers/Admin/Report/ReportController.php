<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Model\PotensiDesa;
use App\Model\Desa;
use App\Model\Sekolah;
use App\Model\Puspem;
use App\Model\Pasar;
use App\Model\TempatIbadah;
use App\Model\Kunjungan;

class ReportController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    
    public function semuaPotensiDesa()
    {
        $potensiDesa = PotensiDesa::get();
        return view('admin/report/report', compact('potensiDesa'));
    }

    public function detailPotensiDesa(Desa $desa)
    {
        $pasar = Pasar::where('id_desa', $desa->id)->where('deleted_at', NULL)->get();
        $puspem = Puspem::where('id_desa', $desa->id)->where('deleted_at', NULL)->get();
        $sekolah = Sekolah::where('id_desa', $desa->id)->where('deleted_at', NULL)->get();
        $tempatIbadah = TempatIbadah::where('id_desa', $desa->id)->where('deleted_at', NULL)->get();

        $jumlahPotensiDesa = [];
        $potensiDesa = PotensiDesa::where('id_desa', $desa->id)->first();
        $jumlahPotensiDesa[] = $potensiDesa->pasar;
        $jumlahPotensiDesa[] = $potensiDesa->pusat_pemerintahan;
        $jumlahPotensiDesa[] = $potensiDesa->sekolah;
        $jumlahPotensiDesa[] = $potensiDesa->tempat_ibadah;

        return view('admin/report/detail-report', compact('jumlahPotensiDesa', 'potensiDesa', 'pasar', 'sekolah', 'puspem', 'tempatIbadah'));
    }

    public function jumlahKunjungan(Request $request, Desa $desa)
    {
        $date = Carbon::now()->setTimezone('GMT+8');
        $potensiDesa = PotensiDesa::where('id_desa', $desa->id)->first();

        $kunjungan;
        $jumlah_kunjungan = [];
        $data_kunjungan = [];

        if ($request->rentang_waktu == 'Hari Ini') {
            $tanggal = $date->format('d');
            $bulan = $date->format('m');
            $tahun = $date->format('Y');
            $kunjungan = Kunjungan::where('id_desa', $desa->id)
                ->where('tanggal_kunjungan', $tanggal)
                ->where('bulan_kunjungan', $bulan)
                ->where('tahun_kunjungan', $tahun)
            ->get();
            $data_kunjungan = $kunjungan;
        } elseif ($request->rentang_waktu == 'Kemarin') {
            $kemarin = $date->subDay(1);
            $tanggal = $kemarin->format('d');
            $bulan = $kemarin->format('m');
            $tahun = $kemarin->format('Y');
            $kunjungan = Kunjungan::where('id_desa', $desa->id)
                ->where('tanggal_kunjungan', $tanggal)
                ->where('bulan_kunjungan', $bulan)
                ->where('tahun_kunjungan', $tahun)
            ->get();
            $data_kunjungan = $kunjungan;
        } elseif ($request->rentang_waktu == 'Bulan Ini') {
            $bulan = $date->format('m');
            $tahun = $date->format('Y');
            $kunjungan = Kunjungan::where('id_desa', $desa->id)
                ->where('bulan_kunjungan', $bulan)
                ->where('tahun_kunjungan', $tahun)
            ->get();
            $data_kunjungan = $kunjungan;
        } elseif ($request->rentang_waktu == 'Bulan Lalu') {
            $bln_lalu = $date->subMonths(1);
            $bulan = $bln_lalu->format('m');
            $tahun = $bln_lalu->format('Y');
            $kunjungan = Kunjungan::where('id_desa', $desa->id)
                ->where('bulan_kunjungan', $bulan)
                ->where('tahun_kunjungan', $tahun)
            ->get();
            $data_kunjungan = $kunjungan;
        } elseif ($request->rentang_waktu == 'Tahun Ini') {
            $tahun = $date->format('Y');
            $kunjungan = Kunjungan::where('id_desa', $desa->id)
                ->where('tahun_kunjungan', $tahun)
            ->get();
            $data_kunjungan = $kunjungan;
        } elseif ($request->rentang_waktu == 'Tahun Lalu') {
            $thn_lalu = $date->subYears(1);
            $tahun = $thn_lalu->format('Y');
            $kunjungan = Kunjungan::where('id_desa', $desa->id)
                ->where('tahun_kunjungan', $tahun)
            ->get();
            $data_kunjungan = $kunjungan;
        }

        $jumlah_kunjungan[] = $kunjungan->where('jenis_potensi', 'Pasar')->count();
        $jumlah_kunjungan[] = $kunjungan->where('jenis_potensi', 'Pusat Pemerintahan')->count();
        $jumlah_kunjungan[] = $kunjungan->where('jenis_potensi', 'Sekolah')->count();
        $jumlah_kunjungan[] = $kunjungan->where('jenis_potensi', 'Tempat Ibadah')->count();
        // foreach ($data_kunjungan->where('jenis_potensi', 'Pasar') as $data) {
        //     $jumlah_kunjungan[] = $data-;
        // }
        return view('admin/report/jumlah-kunjungan', compact('jumlah_kunjungan', 'potensiDesa'));
        
    }
}
