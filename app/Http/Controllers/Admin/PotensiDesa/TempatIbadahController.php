<?php

namespace App\Http\Controllers\Admin\PotensiDesa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Mover;
use App\Model\TempatIbadah;
use App\Model\Desa;
use App\Model\JenisPotensi;
use App\Model\PotensiDesa;

class TempatIbadahController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
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
        $this->validate($request,[
            'lokasi_desa' => "required",
            'nama_tempat_ibadah' => "required|regex:/^[a-z ,.'-]+$/i|min:3|max:100",
            'foto' => "image|mimes:jpeg,png,jpg|max:5000",
            'umat_agama' => "required",
            'alamat' => "required|regex:/^[a-z0-9 ,.'-]+$/i|min:3",
            'latTempatIbadah' => "required",
            'lngTempatIbadah' => "required",
        ],
        [
            'lokasi_desa.required' => "Lokasi desa wajib dipilih",
            'nama_tempat_ibadah.required' => "Nama tempat ibadah wajib diisi",
            'nama_tempat_ibadah.regex' => "Format penulisan nama tempat ibadah tidak sesuai",
            'nama_tempat_ibadah.min' => "Nama tempat ibadah minimal berjumlah 3 karakter",
            'nama_tempat_ibadah.max' => "Nama tempat ibadah maksimal berjumlah 100 karakter",
            'foto.image' => "Foto potensi desa harus berupa gambar",
            'foto.mimes' => "Foto potensi desa harus berupa gambar png, jpg, jpeg",
            'foto.max' => "Foto potensi desa maksimal berukuran 5 Mb",
            'umat_agama.required' => "Umat Agama tempat ibadah wajib dipilih",
            'alamat.required' => "Alamat tempat ibadah wajib diisi",
            'alamat.regex' => "Format penulisan alamat tempat ibadah tidak sesuai",
        ]);
        
        if ($request->foto == NULL) {
            $filename = NULL;
        } else {
            $filename = Mover::moverImg($request->file('foto'), 'app/images/marker/tempatIbadah/');
        }

        $tempatIbadah = TempatIbadah::create([
            'id_desa' => $request->lokasi_desa,
            'id_jenis_potensi' => 3,
            'nama' => $request->nama_tempat_ibadah,
            'foto' => $filename,
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

    public function imgTempatIbadah(TempatIbadah $tempatIbadah)
    {
        if ($tempatIbadah->foto != NULL) {
            if(File::exists(storage_path($tempatIbadah->foto))) {
                return response()->file(
                    storage_path($tempatIbadah->foto)
                );
            } else {
                return response()->file(
                    public_path('default-potensi-desa.png')
                );
            }
        } else {
            return response()->file(
                public_path('default-potensi-desa.png')
            );
        }
        
    }

    public function updateTempatIbadah(Request $request, TempatIbadah $tempatIbadah)
    {
        $this->validate($request,[
            'lokasi_desa' => "required",
            'nama_tempat_ibadah' => "required|regex:/^[a-z ,.'-]+$/i|min:3|max:100",
            'foto' => "image|mimes:jpeg,png,jpg|max:5000",
            'umat_agama' => "required",
            'alamat' => "required|regex:/^[a-z0-9 ,.'-]+$/i|min:3",
            'latTempatIbadah' => "required",
            'lngTempatIbadah' => "required",
        ],
        [
            'lokasi_desa.required' => "Lokasi desa wajib dipilih",
            'nama_tempat_ibadah.required' => "Nama tempat ibadah wajib diisi",
            'nama_tempat_ibadah.regex' => "Format penulisan nama tempat ibadah tidak sesuai",
            'nama_tempat_ibadah.min' => "Nama tempat ibadah minimal berjumlah 3 karakter",
            'nama_tempat_ibadah.max' => "Nama tempat ibadah maksimal berjumlah 100 karakter",
            'foto.image' => "Foto tempat ibadah harus berupa gambar",
            'foto.mimes' => "Foto tempat ibadah harus berupa gambar png, jpg, jpeg",
            'foto.max' => "Foto tempat ibadah maksimal berukuran 5 Mb",
            'umat_agama.required' => "Umat Agama tempat ibadah wajib dipilih",
            'alamat.required' => "Alamat tempat ibadah wajib diisi",
            'alamat.regex' => "Format penulisan alamat tempat ibadah tidak sesuai",
        ]);

        if (
            $request->lokasi_desa == $tempatIbadah->id_desa &&
            $request->nama_tempat_ibadah == $tempatIbadah->nama &&
            $request->umat_agama == $tempatIbadah->agama && 
            $request->alamat == $tempatIbadah->alamat && 
            $request->latTempatIbadah == $tempatIbadah->lat && 
            $request->lngTempatIbadah == $tempatIbadah->lng &&
            $request->file('foto') == NULL
        ) {
            return redirect()->back()->with('success', 'Data Potensi Desa (Tempat Ibadah) Berhasil Disimpan');
        } else {
            if ($tempatIbadah->foto == NULL) {
                $imgMarker = 'NULL';

                if ($request->file('foto') == NULL) {
                    $imgMarker = NULL;
                } else {
                    $filename = Mover::moverImg($request->file('foto'), 'app/images/marker/tempatIbadah/');
                    $imgMarker = $filename;
                }
            } else {
                if ($request->file('foto') == NULL) {
                    $imgMarker = $tempatIbadah->foto;
                } else {
                    $filename = Mover::moverImg($request->file('foto'), 'app/images/marker/tempatIbadah/');
                    $imgMarker = $filename;
                }
            }

            $updateTempatIbadah = TempatIbadah::where('id', $tempatIbadah->id)->update([
                'id_desa' => $request->lokasi_desa,
                'nama' => $request->nama_tempat_ibadah,
                'foto' => $imgMarker,
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
