<?php

namespace App\Http\Controllers\Admin\PotensiDesa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Model\Sekolah;
use App\Model\Desa;
use App\Model\JenisPotensi;
use App\Model\PotensiDesa;

class SekolahController extends Controller
{
    public function semuaSekolah()
    {
        $sekolah = Sekolah::where('deleted_at', NULL)->orderBy('id', 'desc')->get();
        return view('admin/potensi-desa/sekolah/semua-sekolah', compact('sekolah'));
    }

    public function tambahSekolah()
    {
        $desa = Desa::get();
        return view('admin/potensi-desa/sekolah/tambah-sekolah', compact('desa'));
    }

    public function simpanSekolah(Request $request)
    {
        $sekolah = Sekolah::create([
            'id_desa' => $request->lokasi_desa,
            'id_jenis_potensi' => 3,
            'nama' => $request->nama_sekolah,
            'jenjang' => $request->jenjang,
            'jenis_sekolah' => $request->jenis_sekolah,
            'alamat' => $request->alamat,
            'lat' => $request->latSekolah,
            'lng' => $request->lngSekolah,
        ]);

        $cekPotensiDesa = PotensiDesa::where('id_desa', $request->lokasi_desa)->first();
        if ($cekPotensiDesa) {
            $potensiDesa = PotensiDesa::where('id_desa', $request->lokasi_desa)->update([
                'sekolah' => $cekPotensiDesa->sekolah + 1
            ]);
        } else {
            $potensiDesa = PotensiDesa::create([
                'id_desa' => $request->lokasi_desa,
                'sekolah' => 1,
            ]);
        }

        if ($sekolah && $potensiDesa) {
            return redirect()->back()->with('success', 'Data Potensi Desa (Sekolah) Berhasil Ditambahkan');
        } else {
            return redirect()->back()->with('failed', 'Data Potensi Desa Gagal Ditambahkan');
        }
    }

    public function detailSekolah(Sekolah $sekolah)
    {
        $desa = Desa::get();
        $satuDesa = Desa::where('id', $sekolah->id_desa)->get();

        return view('admin/potensi-desa/sekolah/detail-sekolah', compact('sekolah', 'desa', 'satuDesa'));
    }

    public function updateSekolah(Request $request, Sekolah $sekolah)
    {
        if (
            $request->lokasi_desa == $sekolah->id_desa && 
            $request->nama_sekolah == $sekolah->nama && 
            $request->jenjang == $sekolah->jenjang && 
            $request->jenis_sekolah == $sekolah->jenis_sekolah && 
            $request->alamat == $sekolah->alamat && 
            $request->latSekolah == $sekolah->lat && 
            $request->lngSekolah == $sekolah->lng
        ) {
            return redirect()->back()->with('success', 'Data Potensi Desa (Sekolah) Berhasil Disimpan');
        } else {
            $updateSekolah = Sekolah::where('id', $sekolah->id)->update([
                'id_desa' => $request->lokasi_desa,
                'nama' => $request->nama_sekolah,
                'jenjang' => $request->jenjang,
                'jenis_sekolah' => $request->jenis_sekolah,
                'alamat' => $request->alamat,
                'lat' => $request->latSekolah,
                'lng' => $request->lngSekolah,
            ]);
    
            if ($updateSekolah) {
                return redirect()->back()->with('success', 'Data Potensi Desa (Sekolah) Berhasil Ditambahkan');
            } else {
                return redirect()->back()->with('failed', 'Data Potensi Desa Gagal Ditambahkan');
            }
        }
    }

    public function hapusSekolah(Sekolah $sekolah)
    {
        $today = Carbon::now()->setTimezone('GMT+8')->toDateString();
        $cekPotensiDesa = PotensiDesa::where('id_desa', $sekolah->id_desa)->first();
    
        $hapusSekolah = Sekolah::where('id', $sekolah->id)->update([
            'deleted_at' => $today
        ]);

        $potensiSekolah = PotensiDesa::where('id_desa', $sekolah->id_desa)->get();
        if (count($potensiSekolah) < 1) {
            $potensiDesa = PotensiDesa::where('id_desa', $sekolah->id_desa)->update([
                'sekolah' => NULL
            ]);
        } else {
            $potensiDesa = PotensiDesa::where('id_desa', $sekolah->id_desa)->update([
                'sekolah' => $cekPotensiDesa->sekolah - 1
            ]);
        }

        if ($hapusSekolah && $potensiDesa) {
            return redirect()->back()->with('success', 'Data Potensi Desa (Sekolah) Berhasil Dihapus');
        } else {
            return redirect()->back()->with('failed', 'Data Potensi Desa Gagal Dihapus');
        }
    }
}
