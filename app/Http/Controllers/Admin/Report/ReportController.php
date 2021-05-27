<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\PotensiDesa;

class ReportController extends Controller
{
    public function semuaPotensiDesa()
    {
        $potensiDesa = PotensiDesa::get();
        return view('admin/report/report', compact('potensiDesa'));
    }
}
