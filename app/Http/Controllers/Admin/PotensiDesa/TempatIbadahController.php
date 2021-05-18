<?php

namespace App\Http\Controllers\Admin\PotensiDesa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TempatIbadahController extends Controller
{
    public function semuaTempatIbadah()
    {
        return view('admin/potensi-desa/tempat-ibadah/semua-tempat-ibadah');
    }
}
