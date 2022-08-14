<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $data['menu']   = 'Dashboard';
        
        return view('web.dashboard', $data);
    }

    public function nasabah()
    {
        $data['menu']   = 'Nasabah';

        return view('web.nasabah', $data);
    }

    public function riwayat()
    {
        $data['menu']   = 'Riwayat';

        return view('web.riwayat', $data);
    }

    public function inputDataAnggota()
    {
        $data['menu']   = 'Input Data Nasabah';

        return view('web.input-data.anggota', $data);
    }

    public function inputDataInformasi(Request $request)
    {
        $data['menu']   = 'Input Data Informasi';

        return view('web.input-data.informasi', $data);
    }

    public function inputDataFoto(Request $request)
    {
        $data['menu']   = 'Input Data Foto';

        return view('web.input-data.foto', $data);
    }

    public function inputDataPenghasilan(Request $request)
    {
        $data['menu']   = 'Input Data Penghasilan';

        return view('web.input-data.penghasilan', $data);
    }

    public function konfirmasiData(Request $request)
    {
        $data['menu']   = 'Konfirmasi Data';

        return view('web.input-data.konfirmasi', $data);
    }
}
