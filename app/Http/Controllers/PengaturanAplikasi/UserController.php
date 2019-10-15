<?php

namespace App\Http\Controllers\PengaturanAplikasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('PengaturanAplikasi.UserController.index');
    }

    public function create()
    {
        return view('PengaturanAplikasi.UserController.create');
    }
}
