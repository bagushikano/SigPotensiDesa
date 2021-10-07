<?php

namespace App\Http\Controllers\Admin\PotensiDesa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Mover;
use App\Model\Puspem;
use App\Model\Desa;
use App\Model\JenisPotensi;
use App\Model\PotensiDesa;

class PuspemController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    
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
        $this->validate($request,[
            'lokasi_desa' => "required",
            'nama_puspem' => "required|regex:/^[a-z ,.'-]+$/i|min:3|max:100",
            'foto' => "image|mimes:jpeg,png,jpg|max:5000",
            'tingkat_pemerintahan' => "required",
            'alamat' => "required|regex:/^[a-z0-9 ,.'-]+$/i|min:3",
            'latPuspem' => "required",
            'lngPuspem' => "required",
        ],
        [
            'lokasi_desa.required' => "Lokasi desa wajib dipilih",
            'nama_puspem.required' => "Nama pusat pemerintahan wajib diisi",
            'nama_puspem.regex' => "Format penulisan nama pusat pemerintahan tidak sesuai",
            'nama_puspem.min' => "Nama pusat pemerintahan minimal berjumlah 3 karakter",
            'nama_puspem.max' => "Nama pusat pemerintahan maksimal berjumlah 100 karakter",
            'foto.image' => "Foto potensi desa harus berupa gambar",
            'foto.mimes' => "Foto potensi desa harus berupa gambar png, jpg, jpeg",
            'foto.max' => "Foto potensi desa maksimal berukuran 5 Mb",
            'tingkat.required' => "Tingkat Pemerintahan wajib dipilih",
            'alamat.required' => "Alamat pusat pemerintahan wajib diisi",
            'alamat.regex' => "Format penulisan alamat pusat pemerintahan tidak sesuai",
        ]);

        if ($request->foto == NULL) {
            $filename = NULL;
        } else {
            $filename = Mover::moverImg($request->file('foto'), 'app/images/marker/puspem/');
        }

        $puspem = Puspem::create([
            'id_desa' => $request->lokasi_desa,
            'id_jenis_potensi' => 2,
            'nama' => $request->nama_puspem,
            'foto' => $filename,
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

    public function imgPuspem(Puspem $puspem)
    {
        if ($puspem->foto != NULL) {
            if(File::exists(storage_path($puspem->foto))) {
                return response()->file(
                    storage_path($puspem->foto)
                );
            } else {
                return response()->file(
                    public_path('/default-potensi-desa.png')
                );
            }
        } else {
            return response()->file(
                public_path('/default-potensi-desa.png')
            );
        }
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
        $this->validate($request,[
            'lokasi_desa' => "required",
            'nama_puspem' => "required|regex:/^[a-z ,.'-]+$/i|min:3|max:100",
            'foto' => "image|mimes:jpeg,png,jpg|max:5000",
            'tingkat_pemerintahan' => "required",
            'alamat' => "required|regex:/^[a-z0-9 ,.'-]+$/i|min:3",
            'latPuspem' => "required",
            'lngPuspem' => "required",
        ],
        [
            'lokasi_desa.required' => "Lokasi desa wajib dipilih",
            'nama_puspem.required' => "Nama pusat pemerintahan wajib diisi",
            'nama_puspem.regex' => "Format penulisan nama pusat pemerintahan tidak sesuai",
            'nama_puspem.min' => "Nama pusat pemerintahan minimal berjumlah 3 karakter",
            'nama_puspem.max' => "Nama pusat pemerintahan maksimal berjumlah 100 karakter",
            'foto.image' => "Foto pusat pemerintahan harus berupa gambar",
            'foto.mimes' => "Foto pusat pemerintahan harus berupa gambar png, jpg, jpeg",
            'foto.max' => "Foto pusat pemerintahan maksimal berukuran 5 Mb",
            'tingkat.required' => "Tingkat Pemerintahan wajib dipilih",
            'alamat.required' => "Alamat pusat pemerintahan wajib diisi",
            'alamat.regex' => "Format penulisan alamat pusat pemerintahan tidak sesuai",
        ]);

        if (
            $request->lokasi_desa == $puspem->id_desa &&
            $request->nama_puspem == $puspem->nama &&
            $request->tingkat_pemerintahan == $puspem->tingkat &&
            $request->alamat == $puspem->alamat &&
            $request->latPuspem == $puspem->lat &&
            $request->lngPuspem == $puspem->lng &&
            $request->file('foto') == NULL
        ) {
            return redirect()->back()->with('success', 'Data Potensi Desa (Pusat Pemerintahan) Berhasil Disimpan');
        } else {
            if ($puspem->foto == NULL) {
                $imgMarker = 'NULL';

                if ($request->file('foto') == NULL) {
                    $imgMarker = NULL;
                } else {
                    $filename = Mover::moverImg($request->file('foto'), 'app/images/marker/puspem/');
                    $imgMarker = $filename;
                }
            } else {
                if ($request->file('foto') == NULL) {
                    $imgMarker = $puspem->foto;
                } else {
                    $filename = Mover::moverImg($request->file('foto'), 'app/images/marker/puspem/');
                    $imgMarker = $filename;
                }
            }

            $updatePuspem = Puspem::where('id', $puspem->id)->update([
                'id_desa' => $request->lokasi_desa,
                'nama' => $request->nama_puspem,
                'foto' => $imgMarker,
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
