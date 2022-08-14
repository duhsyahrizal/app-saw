<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Nasabah;

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

    public function postDataNasabah(Request $request)
    {
        $messages = [
            'name'  => ':attribute must be least than :min digit',
            'nik'   => ':attribute must be :max digit',
        ];

        $isValidate = Validator::make($request->all(), [
            'name'  => 'required|max:100|min:10',
            'nik'   => 'required|max:16'
        ], $messages);

        if($isValidate->fails()) {
            return redirect()->back()
                ->withErrors($isValidate)
                ->withInput();
        }

        $isCreated  = Nasabah::create([
            'name_by_identity'  => $request->name,
            'nik'               => $request->nik
        ]);

        if(!$isCreated) {
            return redirect()->back()
                ->withErrors('Failed when created nasabah!');
        }

        return redirect('/nasabah')
            ->withSuccess('Success created data nasabah!');
    }

    public function inputDataInformasi(Request $request)
    {
        $data['menu']       = 'Input Persyaratan Nasabah';
        $data['nasabah']    = Nasabah::get();

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
