<?php

namespace App\Http\Controllers\Admin\PotensiDesa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Model\Pasar;
use App\Model\Desa;
use App\Model\JenisPotensi;
use App\Model\PotensiDesa;

class PasarController extends Controller
{
    public function semuaPasar()
    {
        $pasar = Pasar::where('deleted_at', NULL)->orderBy('id', 'desc')->get();
        return view('admin/potensi-desa/pasar/semua-pasar', compact('pasar'));
    }

    public function tambahPasar()
    {
        $desa = Desa::get();
        return view('admin/potensi-desa/pasar/tambah-pasar', compact('desa'));
    }
    
    public function simpanPasar(Request $request)
    {
        $pasar = Pasar::create([
            'id_desa' => $request->lokasi_desa,
            'id_jenis_potensi' => 1,
            'nama' => $request->nama_pasar,
            'alamat' => $request->alamat,
            'lat' => $request->latPasar,
            'lng' => $request->lngPasar,
        ]);

        $cekPotensiDesa = PotensiDesa::where('id_desa', $request->lokasi_desa)->first();
        if ($cekPotensiDesa) {
            $potensiDesa = PotensiDesa::where('id_desa', $request->lokasi_desa)->update([
                'pasar' => $cekPotensiDesa->pasar + 1
            ]);
        } else {
            $potensiDesa = PotensiDesa::create([
                'id_desa' => $request->lokasi_desa,
                'pasar' => 1,
            ]);
        }

        if ($pasar && $potensiDesa) {
            return redirect()->back()->with('success', 'Data Potensi Desa (Pasar) Berhasil Ditambahkan');
        } else {
            return redirect()->back()->with('failed', 'Data Potensi Desa Gagal Ditambahkan');
        }
    }

    public function detailPasar(Pasar $pasar)
    {
        $desa = Desa::get();
        $satuDesa = Desa::where('id', $pasar->id_desa)->get();

        return view('admin/potensi-desa/pasar/detail-pasar', compact('pasar', 'desa', 'satuDesa'));
    }

    public function hapusPasar(Pasar $pasar)
    {
        $today = Carbon::now()->setTimezone('GMT+8')->toDateString();
        $cekPotensiDesa = PotensiDesa::where('id_desa', $pasar->id_desa)->first();
    
        $hapusPasar = Pasar::where('id', $pasar->id)->update([
            'deleted_at' => $today
        ]);

        $potensiDesa = PotensiDesa::where('id_desa', $pasar->id_desa)->update([
            'pasar' => $cekPotensiDesa->pasar - 1
        ]);

        if ($hapusPasar && $potensiDesa) {
            return redirect()->back()->with('success', 'Data Potensi Desa (Pasar) Berhasil Dihapus');
        } else {
            return redirect()->back()->with('failed', 'Data Potensi Desa Gagal Dihapus');
        }
    }

    public function updatePasar(Request $request, Pasar $pasar)
    {
        if ($request->lokasi_desa == $pasar->id_desa && $request->nama_pasar == $pasar->nama && $request->alamat == $pasar->alamat && $request->latPasar == $pasar->lat && $request->lngPasar == $pasar->lng) {
            return redirect()->back()->with('success', 'Data Potensi Desa (Pasar) Berhasil Disimpan');
        } else {
            $updatePasar = Pasar::where('id', $pasar->id)->update([
                'id_desa' => $request->lokasi_desa,
                'nama' => $request->nama_pasar,
                'alamat' => $request->alamat,
                'lat' => $request->latPasar,
                'lng' => $request->lngPasar,
            ]);
    
            if ($updatePasar) {
                return redirect()->back()->with('success', 'Data Potensi Desa (Pasar) Berhasil Ditambahkan');
            } else {
                return redirect()->back()->with('failed', 'Data Potensi Desa Gagal Ditambahkan');
            }
        }
        
    }
}