<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        $title = 'Master Login - LV Travel';
        return view('master.login', compact('title'));
    }
    public function register()
    {
        $title = 'Master Registation - LV Travel';
        return view('master.register', compact('title'));
    }
}
