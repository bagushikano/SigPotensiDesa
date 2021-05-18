<?php

namespace App\Http\Controllers\Admin\PotensiDesa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PuspemController extends Controller
{
    public function semuaPuspem()
    {
        return view('admin/potensi-desa/pusat-pemerintahan/semua-puspem');
    }
}
