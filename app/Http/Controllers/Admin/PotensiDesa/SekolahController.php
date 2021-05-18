<?php

namespace App\Http\Controllers\Admin\PotensiDesa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SekolahController extends Controller
{
    public function semuaSekolah()
    {
        return view('admin/potensi-desa/sekolah/semua-sekolah');
    }
}
