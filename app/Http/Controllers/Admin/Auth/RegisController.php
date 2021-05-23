<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Model\Admin;

class RegisController extends Controller
{
    // Access only on API
    public function register(Request $request)
    {
        $admin = Admin::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);

        if ($admin) {
            return ('Sukses');
        } else {
            return ('Gagal');
        }
    }

    public function tambahAdmin(Request $request)
    {
        $this->validate($request, [
            'nama_admin' => "required|regex:/^[a-z ,.'-]+$/i|min:3|max:50",
            'alamat_admin' => "required|regex:/^[a-z0-9 ,.'-]+$/i|min:3",
            'no_telp_admin' => "required|numeric|digits_between:12,15|unique:tb_admin,nomor_telepon",
            'username_admin' => "required|min:6|max:27|unique:tb_admin,username",
        ],
        [
            'nama_admin.required' => "Nama admin wajib diisi",
            'nama_admin.regex' => "Format penulisan nama tidak sesuai",
            'nama_admin.min' => "Nama admin minimal berjumlah 3 karakter",
            'nama_admin.max' => "Nama admin minimal berjumlah 50 karakter",
            'alamat_admin.required' => "Alamat wajib diisi",
            'alamat_admin.regex' => "Format penulisan alamat tidak sesuai",
            'alamat_admin.min' => "Alamat minimal berjumlah 3 karakter",
            'no_telp_admin.required' => "Nomor telepon wajib diisi",
            'no_telp_admin.numeric' => "Nomor telepon harus berupa angka",
            'no_telp_admin.digits_between' => "Nomor telepon harus berjumlah 12-15 angka",
            'username_admin.required' => "Username wajib diisi",
            'username_admin.min' => "Username minimal berjumlah 6 karakter",
            'username_admin.max' => "Username minimal berjumlah 27 karakter",
        ]);

        $admin = Admin::create([
            'nama' => $request->nama_admin,
            'nomor_telepon' => $request->no_telp_admin,
            'alamat' => $request->alamat_admin,
            'username' => $request->username_admin,
            'password' => bcrypt($request->username_admin),
        ]);

        if ($admin) {
            return redirect()->back()->with('success', 'Data Profile Baru Berhasil Ditambahkan');
        } else {
            return redirect()->back()->with('failed', 'Data Profile Baru Gagal Ditambahkan');
        }
    }
}
