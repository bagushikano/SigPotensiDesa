<?php

namespace App\Http\Controllers\Admin\ManajemenDesa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Desa;

class ManajemenDesaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function semuaDesa()
    {
        $desa = Desa::get();
        return view('admin/manajemen-desa/manajemen-desa', compact('desa'));
    }

    public function tambahDesa(Request $request)
    {
        $this->validate($request,[
            'nama_desa' => "required|min:3|max:100",
        ],
        [
            'nama_desa.required' => "Nama desa wajib diisi",
            'nama_desa.min' => "Nama desa minimal berjumlah 3 karakter",
            'nama_desa.max' => "Nama desa maksimal berjumlah 50 karakter",
        ]);

        $desa = Desa::create([
            'nama' => $request->nama_desa,
        ]);

        if ($desa) {
            return redirect()->back()->with(['confirm' => 'Data Desa Baru Berhasil Ditambahkan. Apakah anda ingin menambahkan batas desa ?']);
        } else {
            return redirect()->back()->with(['failed' => 'Data Desa Baru Gagal Ditambahkan']);
        }   
    }

    public function detailDesa(Desa $desa)
    {
        return view('admin/manajemen-desa/detail-desa', compact('desa'));
    }

    public function polylineDesa(Desa $desa)
    {
        return response()->json([
            'desa' => $desa
        ]);
    }

    public function updateDesa(Request $request, Desa $desa)
    {
        $updateDesa = Desa::where('id', $desa->id)->update([
            'nama' => $request->nama_desa,
            'warna' => $request->warna,
            'batas_wilayah' => $request->batas_wilayah,
        ]);

        if ($updateDesa) {
            return redirect()->back()->with(['success' => 'Data Desa Berhasil Diperbaharui']);
        } else {
            return redirect()->back()->with(['failed' => 'Data Desa Gagal Diperbaharui']);
        }
    }
}
