<?php

namespace App\Http\Controllers\Admin\Images;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Mover;
use App\Model\JenisPotensi;

class ImageController extends Controller
{
    public function getIcon($id)
    {
        $jenisPotensi = JenisPotensi::where('id', $id)->first();
        if(File::exists(storage_path($jenisPotensi->icon))) {
            return response()->file(
                storage_path($jenisPotensi->icon)
            );
        } else {
            return response()->file(
                storage_path('app/icons/defaultmarker.png')
            );
        }
    }
}
