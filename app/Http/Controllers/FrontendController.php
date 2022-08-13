<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        return view('web.dashboard');
    }

    public function inputDataAnggota()
    {
        return view('web.input-data.anggota');
    }

    public function inputDataInformasi(Request $request)
    {
        return view('web.input-data.informasi');
    }

    public function inputDataFoto(Request $request)
    {
        return view('web.input-data.foto');
    }

    public function inputDataPenghasilan(Request $request)
    {
        return view('web.input-data.penghasilan');
    }

    public function konfirmasiData(Request $request)
    {
        return view('web.input-data.konfirmasi');
    }
}
