<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Nasabah;
use App\Models\Riwayat;
use App\Models\Result;

class FrontendController extends Controller
{
    public function index()
    {
        $data['menu']   = 'Dashboard';
        $data['totalNasabah']   = Nasabah::count();
        $data['totalTransaksi'] = Riwayat::count();
        $data['totalPengajuan'] = Result::where('is_approved', true)->count();
        $data['totalBayar']     = Riwayat::where('is_paid', true)->count();
        $data['riwayats']       = Riwayat::get();
        
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
            'name'  => 'Nama tidak boleh lebih dari :min digit',
            'nik'   => 'NIK harus kurang dari :max digit',
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
        $data['menu']       = 'Input Persyaratan Nasabah - Data Calon Anggota';
        $data['nasabah']    = Nasabah::get();

        return view('web.input-data.informasi', $data);
    }

    public function postDataInformasi(Request $request)
    {
        $request->session()->put(['information' => $request->all()]);
        
        return redirect('/input/data/foto');
    }

    public function inputDataFoto()
    {
        $data['menu']   = 'Input Persyaratan Nasabah - Ambil Foto';

        return view('web.input-data.foto', $data);
    }

    public function postDataFoto(Request $request)
    {
        $request->session()->put([
            'foto1'  => $request->foto1,
            'foto2'  => $request->foto2,
            'foto3'  => $request->foto3,
            'foto4'  => $request->foto4,
        ]);

        return redirect('/input/data/usaha');
    }

    public function inputDataUsaha(Request $request)
    {
        $data['menu']   = 'Input Persyaratan - Isi Informasi Tambahan & Data Usaha';

        return view('web.input-data.usaha', $data);
    }

    public function konfirmasiData(Request $request)
    {
        $data['menu']   = 'Konfirmasi Data';

        return view('web.input-data.konfirmasi', $data);
    }
}
