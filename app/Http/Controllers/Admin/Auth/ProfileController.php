<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Model\Admin;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function updateProfile(Admin $admin, Request $request)
    {
        $this->validate($request, [
            'nama' => "required|regex:/^[a-z ,.'-]+$/i|min:3|max:50",
            'alamat' => "required|regex:/^[a-z0-9 ,.'-]+$/i|min:3",
            'nomor_telepon' => "required|numeric|digits_between:12,15",
            'username' => "required|min:6|max:27",
        ],
        [
            'nama.required' => "Nama admin wajib diisi",
            'nama.regex' => "Format penulisan nama tidak sesuai",
            'nama.min' => "Nama admin minimal berjumlah 3 karakter",
            'nama.max' => "Nama admin minimal berjumlah 50 karakter",
            'alamat.required' => "Alamat wajib diisi",
            'alamat.regex' => "Format penulisan alamat tidak sesuai",
            'alamat.min' => "Alamat minimal berjumlah 3 karakter",
            'nomor_telepon.required' => "Nomor telepon wajib diisi",
            'nomor_telepon.numeric' => "Nomor telepon harus berupa angka",
            'nomor_telepon.digits_between' => "Nomor telepon harus berjumlah 12-15 angka",
            'username.required' => "Username wajib diisi",
            'username.min' => "Username minimal berjumlah 6 karakter",
            'username.max' => "Username minimal berjumlah 27 karakter",
        ]);

        if ($request->nomor_telepon != $admin->nomor_telepon) {
            $this->validate($request, [
                'nomor_telepon' => "unique:tb_admin,nomor_telepon",
            ],
            [
                'nomor_telepon.unique' => "Nomor telepon tidak dapat digunakan",
            ]);
        }

        if ($request->username != $admin->username) {
            $this->validate($request, [
                'username' => "unique:tb_admin,username",
            ],
            [
                'username.unique' => "Username tidak dapat digunakan",
            ]);
        }
        

        $updateAdmin = Admin::where('id', $admin->id)->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'nomor_telepon' => $request->nomor_telepon,
            'username' => $request->username,
        ]);

        if ($updateAdmin) {
            return redirect()->back()->with('success', 'Data Profile Anda Berhasil di Ubah');
        } else {
            return redirect()->back()->with('failed', 'Data Profile Anda Gagal di Ubah');
        }
    }

    public function ubahPassword(Admin $admin, Request $request)
    {
        $this->validate($request, [
            'password' => "required|min:6",
            'new_password' => 'required|confirmed|min:6'
        ],
        [
            'password.required' => "Password lama wajib diisi",
            'password.min' => "Password minimal berjumlah 6 karakter",
            'new_password.required' => "Password baru wajib diisi",
            'new_password.confirmed' => "Konfirmasi password baru tidak sesuai",
            'new_password.min' => "Password minimal berjumlah 6 karakter",
        ]);

        if (Hash::check($request->password, $admin->password)) {
            Admin::where('id', $admin->id)->update([
                'password' => bcrypt($request->new_password)
            ]);
            return redirect()->back()->with('success', 'Password Berhasil di Ubah');
        } else{
            return redirect()->back()->with('failed', 'Password Gagal di Ubah');
        }
    }
}
