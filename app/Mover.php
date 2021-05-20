<?php

namespace App;

use Str;

class Mover
{
    public static function moverImg($image, $folder)
    {
        $image_name = strtolower(time().'_'.$image->getClientOriginalName());
        $image_name = Str::slug($image_name).'.'.strtolower($image->getClientOriginalExtension());
        $image->move(storage_path($folder), $image_name);

        return $folder.$image_name;
    }
}
