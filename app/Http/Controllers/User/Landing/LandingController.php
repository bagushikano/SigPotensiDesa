<?php

namespace App\Http\Controllers\User\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function landing()
    {
        return view('user/landing/index');
    }
}
