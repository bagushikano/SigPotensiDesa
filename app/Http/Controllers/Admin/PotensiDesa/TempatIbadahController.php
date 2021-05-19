<?php

namespace App\Http\Controllers\Admin\PotensiDesa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Model\TempatIbadah;
use App\Model\Desa;
use App\Model\JenisPotensi;
use App\Model\PotensiDesa;

class TempatIbadahController extends Controller
{
    public function semuaTempatIbadah()
    {
        $tempatIbadah = TempatIbadah::where('deleted_at', NULL)->orderBy('id', 'desc')->get();
        return view('admin/potensi-desa/tempat-ibadah/semua-tempat-ibadah', compact('tempatIbadah'));
    }

    public function tambahTempatIbadah()
    {
        $desa = Desa::get();
        return view('admin/potensi-desa/tempat-ibadah/tambah-tempat-ibadah', compact('desa'));
    }

    public function simpanTempatIbadah(Request $request)
    {
        $tempatIbadah = TempatIbadah::create([
            'id_desa' => $request->lokasi_desa,
            'id_jenis_potensi' => 3,
            'nama' => $request->nama_tempat_ibadah,
            'agama' => $request->umat_agama,
            'alamat' => $request->alamat,
            'lat' => $request->latTempatIbadah,
            'lng' => $request->lngTempatIbadah,
        ]);

        $cekPotensiDesa = PotensiDesa::where('id_desa', $request->lokasi_desa)->first();
        if ($cekPotensiDesa) {
            $potensiDesa = PotensiDesa::where('id_desa', $request->lokasi_desa)->update([
                'tempat_ibadah' => $cekPotensiDesa->tempat_ibadah + 1
            ]);
        } else {
            $potensiDesa = PotensiDesa::create([
                'id_desa' => $request->lokasi_desa,
                'tempat_ibadah' => 1,
            ]);
        }

        if ($tempatIbadah && $potensiDesa) {
            return redirect()->back()->with('success', 'Data Potensi Desa (Tempat Ibadah) Berhasil Ditambahkan');
        } else {
            return redirect()->back()->with('failed', 'Data Potensi Desa Gagal Ditambahkan');
        }
    }

    public function detailTempatIbadah(TempatIbadah $tempatIbadah)
    {
        $desa = Desa::get();
        $satuDesa = Desa::where('id', $tempatIbadah->id_desa)->get();

        return view('admin/potensi-desa/tempat-ibadah/detail-tempat-ibadah', compact('tempatIbadah', 'desa', 'satuDesa'));
    }

    public function updateTempatIbadah(Request $request, TempatIbadah $tempatIbadah)
    {
        if (
            $request->lokasi_desa == $tempatIbadah->id_desa &&
            $request->nama_tempat_ibadah == $tempatIbadah->nama &&
            $request->umat_agama == $tempatIbadah->agama && 
            $request->alamat == $tempatIbadah->alamat && 
            $request->latTempatIbadah == $tempatIbadah->lat && 
            $request->lngTempatIbadah == $tempatIbadah->lng
        ) {
            return redirect()->back()->with('success', 'Data Potensi Desa (Tempat Ibadah) Berhasil Disimpan');
        } else {
            $updateTempatIbadah = TempatIbadah::where('id', $tempatIbadah->id)->update([
                'id_desa' => $request->lokasi_desa,
                'nama' => $request->nama_tempat_ibadah,
                'agama' => $request->umat_agama,
                'alamat' => $request->alamat,
                'lat' => $request->latTempatIbadah,
                'lng' => $request->lngTempatIbadah,
            ]);
    
            if ($updateTempatIbadah) {
                return redirect()->back()->with('success', 'Data Potensi Desa (Tempat Ibadah) Berhasil Ditambahkan');
            } else {
                return redirect()->back()->with('failed', 'Data Potensi Desa Gagal Ditambahkan');
            }
        }
    }

    public function hapusTempatIbadah(TempatIbadah $tempatIbadah)
    {
        $today = Carbon::now()->setTimezone('GMT+8')->toDateString();
        $cekPotensiDesa = PotensiDesa::where('id_desa', $tempatIbadah->id_desa)->first();
    
        $hapusTempatIbadah = TempatIbadah::where('id', $tempatIbadah->id)->update([
            'deleted_at' => $today
        ]);

        $potensiTempatIbadah = PotensiDesa::where('id_desa', $tempatIbadah->id_desa)->get();
        if (count($potensiTempatIbadah) < 1) {
            $potensiDesa = PotensiDesa::where('id_desa', $tempatIbadah->id_desa)->update([
                'tempat_ibadah' => NULL
            ]);
        } else {
            $potensiDesa = PotensiDesa::where('id_desa', $tempatIbadah->id_desa)->update([
                'tempat_ibadah' => $cekPotensiDesa->tempat_ibadah - 1
            ]);
        }

        if ($hapusTempatIbadah && $potensiDesa) {
            return redirect()->back()->with('success', 'Data Potensi Desa (Tempat Ibadah) Berhasil Dihapus');
        } else {
            return redirect()->back()->with('failed', 'Data Potensi Desa Gagal Dihapus');
        }
    }
}
