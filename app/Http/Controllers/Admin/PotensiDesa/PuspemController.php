<?php

namespace App\Http\Controllers\Admin\PotensiDesa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Model\Puspem;
use App\Model\Desa;
use App\Model\JenisPotensi;
use App\Model\PotensiDesa;

class PuspemController extends Controller
{
    public function semuaPuspem()
    {
        $puspem = Puspem::where('deleted_at', NULL)->orderBy('id', 'desc')->get();
        return view('admin/potensi-desa/pusat-pemerintahan/semua-puspem', compact('puspem'));
    }

    public function tambahPuspem()
    {
        $desa = Desa::get();
        return view('admin/potensi-desa/pusat-pemerintahan/tambah-puspem', compact('desa'));
    }

    public function simpanPuspem(Request $request)
    {
        // return($request);
        $puspem = Puspem::create([
            'id_desa' => $request->lokasi_desa,
            'id_jenis_potensi' => 2,
            'nama' => $request->nama_puspem,
            'tingkat' => $request->tingkat_pemerintahan,
            'alamat' => $request->alamat,
            'lat' => $request->latPuspem,
            'lng' => $request->lngPuspem,
        ]);

        $cekPotensiDesa = PotensiDesa::where('id_desa', $request->lokasi_desa)->first();
        if ($cekPotensiDesa) {
            $potensiDesa = PotensiDesa::where('id_desa', $request->lokasi_desa)->update([
                'pusat_pemerintahan' => $cekPotensiDesa->pusat_pemerintahan + 1
            ]);
        } else {
            $potensiDesa = PotensiDesa::create([
                'id_desa' => $request->lokasi_desa,
                'pusat_pemerintahan' => 1,
            ]);
        }

        if ($puspem && $potensiDesa) {
            return redirect()->back()->with('success', 'Data Potensi Desa (Pusat Pemerintahan) Berhasil Ditambahkan');
        } else {
            return redirect()->back()->with('failed', 'Data Potensi Desa Gagal Ditambahkan');
        }
    }

    public function detailPuspem(Puspem $puspem)
    {
        $desa = Desa::get();
        $satuDesa = Desa::where('id', $puspem->id_desa)->get();

        return view('admin/potensi-desa/pusat-pemerintahan/detail-puspem', compact('puspem', 'desa', 'satuDesa'));
    }

    public function hapusPuspem(Puspem $puspem)
    {
        $today = Carbon::now()->setTimezone('GMT+8')->toDateString();
        $cekPotensiDesa = PotensiDesa::where('id_desa', $puspem->id_desa)->first();
    
        $hapusPuspem = Puspem::where('id', $puspem->id)->update([
            'deleted_at' => $today
        ]);

        $potensiPuspem = PotensiDesa::where('id_desa', $puspem->id_desa)->get();
        if (count($potensiPuspem) < 1) {
            $potensiDesa = PotensiDesa::where('id_desa', $puspem->id_desa)->update([
                'pusat_pemerintahan' => NULL
            ]);
        } else {
            $potensiDesa = PotensiDesa::where('id_desa', $puspem->id_desa)->update([
                'pusat_pemerintahan' => $cekPotensiDesa->pusat_pemerintahan - 1
            ]);
        }

        if ($hapusPuspem && $potensiDesa) {
            return redirect()->back()->with('success', 'Data Potensi Desa (Pusat Pemerintahan) Berhasil Dihapus');
        } else {
            return redirect()->back()->with('failed', 'Data Potensi Desa Gagal Dihapus');
        }
    }

    public function updatePuspem(Request $request, Puspem $puspem)
    {
        if (
            $request->lokasi_desa == $puspem->id_desa &&
            $request->nama_puspem == $puspem->nama &&
            $request->tingkat_pemerintahan == $puspem->tingkat &&
            $request->alamat == $puspem->alamat &&
            $request->latPuspem == $puspem->lat &&
            $request->lngPuspem == $puspem->lng
        ) {
            return redirect()->back()->with('success', 'Data Potensi Desa (Pusat Pemerintahan) Berhasil Disimpan');
        } else {
            $updatePuspem = Puspem::where('id', $puspem->id)->update([
                'id_desa' => $request->lokasi_desa,
                'nama' => $request->nama_puspem,
                'tingkat' => $request->tingkat_pemerintahan,
                'alamat' => $request->alamat,
                'lat' => $request->latPuspem,
                'lng' => $request->lngPuspem,
            ]);
    
            if ($updatePuspem) {
                return redirect()->back()->with('success', 'Data Potensi Desa (Pusat Pemerintahan) Berhasil Ditambahkan');
            } else {
                return redirect()->back()->with('failed', 'Data Potensi Desa Gagal Ditambahkan');
            }
        }
        
    }
}
